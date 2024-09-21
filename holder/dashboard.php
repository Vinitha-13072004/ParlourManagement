<?php
include "connection.php";
session_start();
// Check if the user is logged in
if (!isset($_SESSION['shop_id'])) {
    header("Location: ../login.php"); // Redirect to login if not logged in
    exit();
}

$shop_id = $_SESSION['shop_id']; // Assuming shop ID is stored in session

// Fetch appointment counts
$stmt = $conn->prepare("
    SELECT 
        COUNT(*) AS total_appointments, 
        SUM(CASE WHEN availability = 'accepted' THEN 1 ELSE 0 END) AS accepted,
        SUM(CASE WHEN availability = 'rejected' THEN 1 ELSE 0 END) AS rejected,
        SUM(CASE WHEN availability = 'pending' THEN 1 ELSE 0 END) AS pending
    FROM appointments 
    WHERE shop_id = ?
");
$stmt->bind_param("i", $shop_id);
$stmt->execute();
$result = $stmt->get_result();
$appointment_counts = $result->fetch_assoc();

$total_appointments = $appointment_counts['total_appointments'];
$accepted = $appointment_counts['accepted'];
$rejected = $appointment_counts['rejected'];
$pending = $appointment_counts['pending'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
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

        .container {
            padding: 20px;
            width: 95%;
            height: calc(100vh - 60px); /* Ensure it fills remaining space */
            margin: 20px auto;
            display: flex; /* Changed to flex */
            justify-content: space-between; /* Space between boxes */
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

        .box {
            flex: 1; /* Equal width for each box */
            margin: 0 10px; /* Space between boxes */
            border: 2px solid #ff3e8c; /* Pink Border */
            border-radius: 10px;
            height:50%;
            min-height:100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #333; /* Darker Background */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 20px;
            cursor: pointer;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .box:hover {
            transform: scale(1.05); /* Slight zoom on hover */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7);
        }

        .box h2 {
            font-size: 1.2rem;
            color: #ff3e8c; /* Pink */
            margin-bottom: 10px;
        }

        .box p {
            font-size: 2rem;
            color: #ffffff;
            font-weight: bold;
            margin: 0;
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

        /* Other styles remain unchanged... */
        .menu-btn {
    background-color: transparent;
    outline: none;
    border: none;
    color: white;
}

#menu {
    font-size: 2em;
}
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="close">
            <i class="fa-solid fa-xmark" onclick="toggleSidebar()"></i>
        </div>
        <div class="bar current">
            <a href="dashboard.php">Dashboard</a>
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
                <i class="fa-solid fa-bars" id="menu"></i>
            </button>
            <a href="#" class="logo">GlamBUE</a>
        </div>

        <div class="container">
            <div class="box" onclick="window.location.href='manage_appointments.php'">
                <h2>Total Appointments</h2>
                <p><?php echo $total_appointments; ?></p>
            </div>
            <div class="box" onclick="window.location.href='manage_appointments.php'">
                <h2>Accepted Appointments</h2>
                <p><?php echo $accepted; ?></p>
            </div>
            <div class="box" onclick="window.location.href='manage_appointments.php'">
                <h2>Rejected Appointments</h2>
                <p><?php echo $rejected; ?></p>
            </div>
            <div class="box" onclick="window.location.href='manage_appointments.php'">
                <h2>Pending Appointments</h2>
                <p><?php echo $pending; ?></p>
            </div>
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
