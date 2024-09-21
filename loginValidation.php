<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $input_email = $_POST['loginemail'];
    $input_password = $_POST['loginpassword'];

    // Include the database connection file
    include 'connection.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to fetch user details
    $stmt = $conn->prepare("SELECT account_password, account_type FROM account_login WHERE account_email = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param('s', $input_email);
    $stmt->execute();
    $stmt->bind_result($stored_password, $stored_type);

    if ($stmt->fetch()) {
        // Verify the password
        if ($input_password === $stored_password) {
            // Check permissions based on account type
            if ($stored_type === 'admin') {
                $stmt->close(); // Close the initial statement
                
                // Prepare a new statement to fetch the admin_id
                $perm_stmt = $conn->prepare("SELECT account_id FROM admin_details WHERE account_email = ?");
                $perm_stmt->bind_param("s", $input_email);
                $perm_stmt->execute();
                
                // Bind the result
                $perm_stmt->bind_result($admin_id);
                
                // Fetch the result to populate $admin_id
                if ($perm_stmt->fetch()) {
                    $_SESSION['admin_id'] = $admin_id; // Set the session variable only if fetch succeeds
                } else {
                    // Handle case where admin_id could not be found (optional)
                    $error_message = urldecode('Admin ID not found.');
                    header("Location: login.php?error=$error_message");
                    exit();
                }
            
                // Close the statement
                $perm_stmt->close();
            
                // Redirect to admin dashboard
                header("location:admin/dashboard.php"); 
                exit();
            }
             elseif ($stored_type === 'holder') {
                // Close the previous statement
                $stmt->close();

                // Check permissions in holder_details
                $perm_stmt = $conn->prepare("SELECT permission,account_id FROM holder_details WHERE account_email = ?");
                $perm_stmt->bind_param("s", $input_email);
                $perm_stmt->execute();
                $perm_stmt->bind_result($permission,$shop_id);
                $perm_stmt->fetch();

                if ($permission === 'allow') {
                    $_SESSION['shop_id']=$shop_id;
                    header("location:holder/dashboard.php");
                } elseif ($permission === 'reject') {
                    $error_message = urldecode('Access denied: Your account has been rejected.');
                    header("Location: login.php?error=$error_message");
                    exit();
                } elseif ($permission === 'pending') {
                    $error_message = urldecode('Your account is pending approval.');
                    header("Location: login.php?error=$error_message");
                    exit();
                }
                // Close the permission statement
                $perm_stmt->close();
            } elseif ($stored_type === 'user') {
                // Close the previous statement
                $stmt->close();

                // Check permissions in user_details
                $perm_stmt = $conn->prepare("SELECT permission,account_id FROM user_details WHERE account_email = ?");
                $perm_stmt->bind_param("s", $input_email);
                $perm_stmt->execute();
                $perm_stmt->bind_result($permission,$user_id);
                $perm_stmt->fetch();

                if ($permission === 'allow') {
                    $_SESSION['user_id']=$user_id;
                    header("location:user/homepage.php");
                } elseif ($permission === 'reject') {
                    $error_message = urldecode('Access denied: Your account has been rejected.');
                    header("Location: login.php?error=$error_message");
                    exit();
                } elseif ($permission === 'pending') {
                    $error_message = urldecode('Your account is pending approval.');
                    header("Location: login.php?error=$error_message");
                    exit();
                }
                // Close the permission statement
                $perm_stmt->close();
            } else {
                $error_message = urldecode('User not found');
                header("Location: login.php?error=$error_message");
                exit();
            }
        } else {
            $error_message = urldecode('Incorrect password. Please try again.');
            header("Location: login.php?error=$error_message");
            exit();    
        }
    } else {
        $error_message = urldecode('User not found');
        header("Location: login.php?error=$error_message");
        exit();
    }

    // Close the connections
    $stmt->close();
    $conn->close();
}
?>
