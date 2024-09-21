<?php
include 'connection.php';
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location:../login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch user's appointments
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("
    SELECT a.appointment_id, h.parlorname, a.appointment_date, a.appointment_time, a.availability 
    FROM appointments a 
    JOIN holder_details h ON a.shop_id = h.account_id 
    WHERE a.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$appointments = $result->fetch_all(MYSQLI_ASSOC);

// Handle appointment cancellation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_appointment'])) {
    $appointment_id = $_POST['appointment_id'];
    
    $stmt = $conn->prepare("DELETE FROM appointments WHERE appointment_id = ?");
    $stmt->bind_param("i", $appointment_id);
    if ($stmt->execute()) {
        echo "<script>alert('Appointment canceled successfully.');</script>";
        header("Refresh:0"); // Refresh the page to update the list
    } else {
        echo "<script>alert('Error canceling appointment.');</script>";
    }
}

// Handle appointment update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_appointment'])) {
    $appointment_id = $_POST['appointment_id'];
    $new_date = $_POST['new_date'];
    $new_time = $_POST['new_time'];
    
    $stmt = $conn->prepare("UPDATE appointments SET appointment_date = ?, appointment_time = ? WHERE appointment_id = ?");
    $stmt->bind_param("ssi", $new_date, $new_time, $appointment_id);
    if ($stmt->execute()) {
        echo "<script>alert('Appointment updated successfully.');</script>";
        header("Refresh:0"); // Refresh the page to update the list
    } else {
        echo "<script>alert('Error updating appointment.');</script>";
    }
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
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            padding: 20px;
        }

        .appointment-card {
            background-color: #111;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .appointment-card h3 {
            margin: 0;
        }

        .availability {
            font-weight: bold;
            padding: 5px;
            border-radius: 3px;
            display: inline-block;
        }

        .pending {
            background-color: orange;
            color: white;
        }

        .accepted {
            background-color: green;
            color: white;
        }

        .rejected {
            background-color: red;
            color: white;
        }

        .btn {
            background-color: #ff3e8c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #ff2e6c;
        }

        .edit-form {
            display: none;
            margin-top: 15px;
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

        /* Header and Menu Button styles */
        .header {
            display: flex;
            height: 60px;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            background-color: #ff3e8c;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
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

        .logo {
            color: white;
            font-size: 24px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="sidebar" id="sidebar">
    <div class="close">
        <i class="fa-solid fa-xmark" onclick="toggleSidebar()"></i>
    </div>
    <div class="bar">
        <a href="homepage.php">Home</a>
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
            <i class="fa-solid fa-bars"></i>
        </button>
        <a href="#" class="logo">GlamBUE</a>
    </div>

    <h1>Your Appointments</h1>

    <?php if (!empty($appointments)): ?>
        <?php foreach ($appointments as $appointment): ?>
            <div class="appointment-card">
                <h3><?php echo htmlspecialchars($appointment['parlorname']); ?></h3>
                <p>Date: <?php echo htmlspecialchars($appointment['appointment_date']); ?></p>
                <p>Time: <?php echo htmlspecialchars($appointment['appointment_time']); ?></p>
                <div class="availability <?php echo ($appointment['availability']); ?>">
                    <?php 
                    switch ($appointment['availability']) {
                        case 'pending':
                            echo 'Pending';
                            break;
                        case 'accepted':
                            echo 'Accepted';
                            break;
                        case 'rejected':
                            echo 'Rejected';
                            break;
                    }
                    ?>
                </div>
                <button class="btn" onclick="toggleEditForm(<?php echo $appointment['appointment_id']; ?>)">Edit</button>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>">
                    <input type="submit" name="cancel_appointment" value="Cancel" class="btn">
                </form>

                <div class="edit-form" id="edit-form-<?php echo $appointment['appointment_id']; ?>">
                    <form method="POST">
                        <input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>">
                        <label for="new_date">New Date:</label>
                        <input type="date" name="new_date" required>
                        <label for="new_time">New Time:</label>
                        <input type="time" name="new_time" required>
                        <input type="submit" name="update_appointment" value="Update" class="btn">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('visible');
    }

    function toggleEditForm(id) {
        var form = document.getElementById('edit-form-' + id);
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }
</script>

</body>
</html>
