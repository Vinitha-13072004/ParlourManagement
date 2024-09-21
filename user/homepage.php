<?php
include 'connection.php';
session_start();

// Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php"); // Redirect to login if not logged in
//     exit();
// }

$selected_location = '';
$shops = [];

// Fetch all allowed shops if search is empty
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['location'])) {
    $selected_location = $_POST['location'];

    // Fetch allowed shops based on entered location
    $stmt = $conn->prepare("SELECT account_id, parlorname, account_email, phonenumber, city FROM holder_details WHERE city=? AND permission='allow'");
    $stmt->bind_param("s", $selected_location);
    $stmt->execute();
    $result = $stmt->get_result();
    $shops = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Fetch all allowed shops when search box is empty
    $result = $conn->query("SELECT account_id, parlorname, account_email, phonenumber, city FROM holder_details WHERE permission='allow'");
    $shops = $result->fetch_all(MYSQLI_ASSOC);
}

// Predefined locations for suggestions
$suggested_locations = ['Pambanar', 'Kuttikanam', 'Mundakayam'];

// Handle appointment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointment'])) {
    $shop_id = $_POST['shop_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Insert appointment into the database
    $stmt = $conn->prepare("INSERT INTO appointments (shop_id, user_id, date, time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $shop_id, $_SESSION['user_id'], $date, $time);
    $stmt->execute();
    // Optionally: Provide feedback to the user (e.g., "Appointment scheduled successfully.")
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* CSS styles remain largely unchanged, with additions for shop display */
        * {
            padding: 0;
            margin: 0;
            font-family: 'Arial', sans-serif;
            box-sizing: border-box;
        }

        body {
            color: #fff;
            background-color: #000;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100vh;
        }

        .header {
            display: flex;
            height: 60px;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            background-color: #ff3e8c; /* Pink */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            padding: 20px;
            background-color: #111; /* Darker background */
            border-right: 2px solid #ff3e8c; /* Pink Border */
            transform: translateX(-100%); /* Initially hidden */
            transition: transform 0.3s ease;
            z-index: 10;
        }

        .sidebar.visible {
            transform: translateX(0); /* Show when visible */
        }

        .sidebar .close {
            display: flex;
            justify-content: flex-end;
        }

        .sidebar .close i {
            font-size: 2em;
            cursor: pointer;
            color: #ff3e8c; /* Pink */
        }

        .sidebar .bar {
            padding: 15px 20px; /* Increased padding */
            margin-top: 15px; /* Adjusted margin */
            background-color: #222; /* Dark background for bars */
            border-radius: 10px; /* Rounded corners */
            color: white;
            text-align: center; /* Center text */
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .sidebar .bar:hover {
            background-color: #ff3e8c; /* Pink */
            color: black;
            transform: scale(1.05);
        }

        .sidebar .bar.current {
            background-color: #ff3e8c; /* Highlight current bar */
            color: black; /* Change text color for current bar */
        }

        .sidebar .bar a {
            display: block; /* Make the link fill the entire bar */
            color: white; /* Default text color */
            text-decoration: none; /* Remove underline */
            font-weight: bold; /* Make the text bold */
            transition: color 0.3s ease; /* Smooth color transition */
        }

        .sidebar .bar a:hover {
            color: black; /* Text color on hover */
        }

        .container {
            padding: 20px;
            width: 95%;
            height: calc(100vh - 60px); /* Ensure it fills remaining space */
            margin: 20px auto;
        }

        .search-container {
            margin-bottom: 20px;
            position: relative; /* For positioning the suggestions */
        }

        input[type="text"] {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 200px; /* Fixed width for the search box */
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #ff3e8c; /* Pink */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            margin-left: 10px; /* Space between input and button */
        }

        input[type="submit"]:hover {
            background-color: #ff2e6c; /* Darker Pink */
        }

        .suggestions {
            position: absolute;
            background-color: white;
            color: black;
            border: 1px solid #ccc;
            z-index: 100;
            width: calc(200px + 20px); /* Adjust width to match input */
            max-height: 150px;
            overflow-y: auto; /* Scrollable if many suggestions */
            border-radius: 5px;
            margin-top: 5px;
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #ff3e8c; /* Highlight on hover */
            color: white; /* Change text color on hover */
        }

        .shop-container {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
        }

        .shop-card {
            background-color: #222;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            color: white;
        }

        .shop-card h3 {
            margin: 0;
            font-size: 1.5rem;
        }

        .shop-card p {
            margin: 5px 0;
        }

        .appointment-btn {
            background-color: #ff3e8c; /* Pink */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .appointment-btn:hover {
            background-color: #ff2e6c; /* Darker Pink */
        }

        .no-shops {
            color: #ff3e8c; /* Pink */
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="close">
            <i class="fa-solid fa-xmark" onclick="toggleSidebar()"></i>
        </div>
        <div class="bar current">
            <a href="user_home.php">Home</a>
        </div>
        <div class="bar">
            <a href="manage_appointments.php">Manage Appointments</a>
        </div>
        <div class="bar">
            <a href="../logout.php">Logout</a>
        </div>
    </div>

    <div class="main-container">
        <div class="header">
            <button class="menu-btn" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars"></i>
            </button>
            <a href="#" class="logo">GlamBUE</a>
        </div>

        <div class="container">
            <form method="POST" class="search-container">
                <input type="text" name="location" id="location" placeholder="Search location..." oninput="showSuggestions(this.value)">
                <input type="submit" value="Search">
                <div class="suggestions" id="suggestions" style="display: none;"></div>
            </form>

            <div class="shop-container">
                <?php if (!empty($shops)): ?>
                    <?php foreach ($shops as $shop): ?>
                        <div class="shop-card">
                            <h3><?php echo htmlspecialchars($shop['parlorname']); ?></h3>
                            <p>Holder Name: <?php echo htmlspecialchars($shop['account_email']); ?></p>
                            <p>Phone Number: <?php echo htmlspecialchars($shop['phonenumber']); ?></p>
                            <p>City: <?php echo htmlspecialchars($shop['city']); ?></p>
                            <button class="appointment-btn" onclick="scheduleAppointment(<?php echo htmlspecialchars($shop['account_id']); ?>)">Make Appointment</button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-shops">No shops available in this location.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        const locations = <?php echo json_encode($suggested_locations); ?>;

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('visible');
        }

        function showSuggestions(value) {
            const suggestionsBox = document.getElementById('suggestions');
            suggestionsBox.innerHTML = '';
            suggestionsBox.style.display = 'none';

            if (!value) {
                return; // Don't show suggestions if input is empty
            }

            const filteredLocations = locations.filter(location => location.toLowerCase().startsWith(value.toLowerCase()));
            if (filteredLocations.length > 0) {
                suggestionsBox.style.display = 'block';
                filteredLocations.forEach(location => {
                    const div = document.createElement('div');
                    div.classList.add('suggestion-item');
                    div.innerText = location;
                    div.onclick = () => selectLocation(location);
                    suggestionsBox.appendChild(div);
                });
            }
        }

        function selectLocation(location) {
            document.getElementById('location').value = location;
            document.getElementById('suggestions').innerHTML = '';
            document.getElementById('suggestions').style.display = 'none';
        }

        function scheduleAppointment(shopId) {
            const date = prompt("Enter appointment date (YYYY-MM-DD):");
            const time = prompt("Enter appointment time (HH:MM):");

            if (date && time) {
                const form = new FormData();
                form.append('appointment', true);
                form.append('shop_id', shopId);
                form.append('date', date);
                form.append('time', time);

                fetch('user_home.php', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.text())
                .then(data => {
                    alert("Appointment scheduled successfully.");
                    // Optionally, refresh the page or update the UI
                })
                .catch(error => {
                    console.error("Error scheduling appointment:", error);
                    alert("Failed to schedule appointment.");
                });
            }
        }
    </script>
</body>
</html>
