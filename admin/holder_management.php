<?php
include 'connection.php';
session_start();
// Check if the user is logged in
// if (!isset($_SESSION['admin_id'])) {
//     header("Location: ../login.php");
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['permission'])) {
    $account_id = $_POST['account_id'];
    $permission = $_POST['permission'];

    $sql = "UPDATE holder_details SET permission=? WHERE account_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $permission, $account_id);
    $stmt->execute();
}

$holders = $conn->query("SELECT account_id, parlorname, account_email, permission FROM holder_details");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holder Management</title>
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: black;
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
        <div class="bar">
            <a href="dashboard.php">Dashboard</a>
        </div>
        <div class="bar current">
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
            <h1>Holder Management</h1>
            <table>
                <tr>
                    <th>Account ID</th>
                    <th>Parlor Name</th>
                    <th>Email</th>
                    <th>Permission</th>
                    <th>Action</th>
                </tr>
                <?php while($holder = $holders->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $holder['account_id']; ?></td>
                    <td><?php echo $holder['parlorname']; ?></td>
                    <td><?php echo $holder['account_email']; ?></td>
                    <td><?php echo $holder['permission']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="account_id" value="<?php echo $holder['account_id']; ?>">
                            <select name="permission">
                                <option value="allow" <?php if($holder['permission'] == 'allow') echo 'selected'; ?>>Allow</option>
                                <option value="pending" <?php if($holder['permission'] == 'pending') echo 'selected'; ?>>Pending</option>
                                <option value="reject" <?php if($holder['permission'] == 'reject') echo 'selected'; ?>>Reject</option>
                            </select>
                            <input type="submit" value="Update">
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
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
