<?php
include "connection.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION['shop_id'])) {
    header("Location: ../login.php"); // Redirect to login if not logged in
    exit();
}

$shop_id = $_SESSION['shop_id']; // Assuming shop ID is stored in session

// Fetch appointments for the holder
$stmt = $conn->prepare("
    SELECT a.*, u.username, u.phonenumber 
    FROM appointments a
    JOIN user_details u ON a.user_id = u.account_id
    WHERE a.shop_id = ?
");
$stmt->bind_param("i", $shop_id);
$stmt->execute();
$result = $stmt->get_result();
$appointments = $result->fetch_all(MYSQLI_ASSOC);

// Function to update appointment availability
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointment_id'], $_POST['availability'])) {
    $appointment_id = $_POST['appointment_id'];
    $availability = $_POST['availability'];

    $update_stmt = $conn->prepare("UPDATE appointments SET availability = ? WHERE appointment_id = ?");
    $update_stmt->bind_param("si", $availability, $appointment_id);
    $update_stmt->execute();

    // Redirect to the same page to see the updated status
    header("Location: manage_appointments.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* Same styles as before */
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
            padding: 20px; /* Reduced padding */
            background-color: #111; /* Darker background */
            border-right: 2px solid #ff3e8c; /* Pink Border */
            transform: translateX(-100%); /* Initially hidden */
            transition: transform 0.3s ease;
            z-index: 10;
        }
        .sidebar.visible {
            transform: translateX(0); /* Show when visible */
        }
        .container {
            padding: 20px;
            width: 95%;
            height: calc(100vh - 60px); /* Ensure it fills remaining space */
            margin: 20px auto;
            display: flex;
            flex-direction: column; /* Stack items vertically */
            gap: 20px; /* Space between appointment items */
        }
        .appointment-card {
            border: 2px solid #ff3e8c; /* Pink Border */
            border-radius: 10px;
            background-color: #333; /* Darker Background */
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        .appointment-card h3 {
            color: #ff3e8c; /* Pink */
        }
        .appointment-card p {
            color: #ffffff;
        }
        .menu-btn {
            background-color: transparent;
            outline: none;
            border: none;
            color: white;
        }
        #menu {
            font-size: 2em;
        }
        .button {
            padding: 10px 15px;
            background-color: #ff3e8c; /* Pink */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #e63977; /* Darker pink */
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            padding: 20px; /* Reduced padding */
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
        
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="close">
            <i class="fa-solid fa-xmark" onclick="toggleSidebar()"></i>
        </div>
        <div class="bar">
            <a href="dashboard.php">Dashboard</a>
        </div>
        <div class="bar current">
            <a href="manage_appointments.php">Manage Appointments</a>
        </div>
        
        <div class="bar">
            <a href="../logout.php">Logout</a>
        </div>
    </div>

    <div class="main-container">
        <div class="header">
            <button class="menu-btn" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars" id="menu"></i>
            </button>
            <a href="#" class="logo">GlamBUE</a>
        </div>

        <div class="container">
            <h2>Manage Appointments</h2>
            <?php foreach ($appointments as $appointment): ?>
                <div class="appointment-card">
                    <h3>Customer Name: <?php echo $appointment['username']; ?></h3>
                    <p>Date: <?php echo $appointment['appointment_date']; ?></p>
                    <p>Time: <?php echo $appointment['appointment_time']; ?></p>
                    <p>Status: <?php echo ucfirst($appointment['availability']); ?></p>
                    <p>Phone Number: <?php echo $appointment['phonenumber']; ?></p>
                    <form method="POST">
                        <input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>">
                        <?php if ($appointment['availability'] === 'pending'): ?>
                            <button type="submit" name="availability" value="accepted" class="button">Accept</button>
                            <button type="submit" name="availability" value="rejected" class="button">Reject</button>
                        <?php elseif ($appointment['availability'] === 'accepted'): ?>
                            <button type="submit" name="availability" value="rejected" class="button">Reject</button>
                        <?php elseif ($appointment['availability'] === 'rejected'): ?>
                            <button type="submit" name="availability" value="accepted" class="button">Accept</button>
                        <?php endif; ?>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('visible');
        }
    </script>
</body>
</html>
