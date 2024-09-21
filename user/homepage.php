<?php
include 'connection.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Redirect to login if not logged in
    exit();
}

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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shop_id'])) {
    $shop_id = $_POST['shop_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Insert appointment into the database
    $stmt = $conn->prepare("INSERT INTO appointments (shop_id, user_id, `appointment_date`, `appointment_time`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $shop_id, $_SESSION['user_id'], $date, $time);
    
    if ($stmt->execute()) {
        echo "<script>alert('Appointment scheduled successfully.');</script>";
    } else {
        echo "<script>alert('Error scheduling appointment.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* Add your CSS styles here */
        * {
            padding: 0;
            margin: 0;
            font-family: 'Arial', sans-serif;
            box-sizing: border-box;
        }
        body {
            color: #fff;
            background-color: #000;
            margin: 0;
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
    padding: 15px 20px;
    margin-top: 15px;
    background-color: #222;
    border-radius: 10px;
    color: white;
    text-align: center;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.sidebar .bar:hover {
    background-color: #ff3e8c;
    color: black;
    transform: scale(1.05);
}

.sidebar .bar.current {
    background-color: #ff3e8c;
    color: black;
}

.sidebar .bar a {
    display: block;
    color: white;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.sidebar .bar a:hover {
    color: black;
}
        .container {
            padding: 20px;
            width: 95%;
            height: calc(100vh - 60px); /* Fill remaining space */
            margin: 20px auto;
        }
        .search-container {
            margin-bottom: 20px;
            position: relative;
        }
        input[type="text"], input[type="date"], input[type="time"] {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%; /* Use full width for better responsiveness */
            max-width: 400px;
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
            margin-left: 10px;
        }
        input[type="submit"]:hover {
            background-color: #ff2e6c; /* Darker Pink */
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
        .appointment-btn {
            background-color: #ff3e8c;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .appointment-btn:hover {
            background-color: #ff2e6c;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }
        .modal-content {
            background-color: #222;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 10px;
            color: white;
        }
        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: white;
            text-decoration: none;
            cursor: pointer;
        }
        .menu-btn {
            background-color: #ff3e8c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 24px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .menu-btn:hover {
            background-color: #ff2e6c;
            transform: scale(1.1);
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
                            <button class="appointment-btn" onclick="openAppointmentModal(<?php echo htmlspecialchars($shop['account_id']); ?>)">Make Appointment</button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-shops">No shops available in this location.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Appointment Modal -->
    <div class="modal" id="appointmentModal">
        <div class="modal-content">
            <span class="close" onclick="closeAppointmentModal()">&times;</span>
            <h2>Schedule Appointment</h2>
            <form id="appointmentForm" method="POST">
                <input type="hidden" name="shop_id" id="shop_id" value="">
                <label for="date">Select Date:</label>
                <input type="date" name="date" id="date" required>
                <label for="time">Select Time:</label>
                <input type="time" name="time" id="time" required>
                <input type="submit" value="Schedule">
            </form>
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

        function openAppointmentModal(shopId) {
            document.getElementById('shop_id').value = shopId;
            document.getElementById('appointmentModal').style.display = 'block';
        }

        function closeAppointmentModal() {
            document.getElementById('appointmentModal').style.display = 'none';
        }
    </script>
</body>
</html>
