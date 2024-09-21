<?php
include "connection.php";
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location:../login.php");
    exit(); 
}
// Fetch counts for users and holders
$users_count = $conn->query("SELECT 
    SUM(permission='allow') AS approved, 
    SUM(permission='pending') AS pending, 
    SUM(permission='reject') AS rejected 
FROM user_details")->fetch_assoc();

$holders_count = $conn->query("SELECT 
    SUM(permission='allow') AS approved, 
    SUM(permission='pending') AS pending, 
    SUM(permission='reject') AS rejected 
FROM holder_details")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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


.container {
    padding: 20px;
    width: 95%;
    height: calc(100vh - 60px); /* Ensure it fills remaining space */
    margin: 20px auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 100px; /* Space between columns */
     /* Decrease the space between rows here */
}


.box {
    height: auto;
    border: 2px solid #ff3e8c; /* Pink Border */
    border-radius: 10px;
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


.menu-btn {
    background-color: transparent;
    outline: none;
    border: none;
    color: white;
}

#menu {
    font-size: 2em;
}

/* Responsive CSS */
@media (max-width: 992px) {
    .container {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .container {
        grid-template-columns: 1fr;
    }
}


    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="close">
            <i class="fa-solid fa-xmark" onclick="toggleSidebar()"></i>
        </div>
        <div class="bar current">
            <a href="admin_dashboard.php">Dashboard</a>
        </div>
        <div class="bar">
            <a href="holder_management.php">Manage Shops</a>
        </div>
        <div class="bar">
            <a href="user_management.php">Manage Users</a>
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
            <div class="box" onclick="window.location.href='user_management.php'">
                <h2>Approved Users</h2>
                <p><?php echo $users_count['approved']; ?></p>
            </div>
            <div class="box" onclick="window.location.href='user_management.php'">
                <h2>Pending Users</h2>
                <p><?php echo $users_count['pending']; ?></p>
            </div>
            <div class="box" onclick="window.location.href='user_management.php'">
                <h2>Rejected Users</h2>
                <p><?php echo $users_count['rejected']; ?></p>
            </div>
            <div class="box" onclick="window.location.href='holder_management.php'">
                <h2>Approved Shops</h2>
                <p><?php echo $holders_count['approved']; ?></p>
            </div>
            <div class="box" onclick="window.location.href='holder_management.php'">
                <h2>Pending Shops</h2>
                <p><?php echo $holders_count['pending']; ?></p>
            </div>
            <div class="box" onclick="window.location.href='holder_management.php'">
                <h2>Rejected Shops</h2>
                <p><?php echo $holders_count['rejected']; ?></p>
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

