<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        // Get the user input
        $input_email = $_POST['loginemail'];
        $input_password = $_POST['loginpassword'];


        // Include the database connection file
        include 'connection.php';

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT account_password,account_type FROM account_login WHERE account_email = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param('s', $input_email);
        $stmt->execute();
        $stmt->bind_result($stored_password,$stored_type);


        if ($stmt->fetch()) {
            // Verify the password
            if ($input_password=== $stored_password) {
                if($stored_type === 'admin'){
                    header("location:admin/index.php");
                }
                elseif($stored_type === 'holder'){
                    header("location:holder/holderhomepage.php");
                }
                elseif($stored_type === 'user'){
                    header("location:user/userhomepage.php");
                }
                else{
                    $error_message = urldecode('User not found');
                    header("Location: login.php?error=$error_message");
                    exit();
                }
            }   
            else {
                $error_message = urldecode('Incorrect password. Please try again.');
                header("Location: login.php?error=$error_message");
                exit();    
            }
        }
        else {
            $error_message = urldecode('User not found');
            header("Location: login.php?error=$error_message");
            exit();
        }


        // Close the connections
        $stmt->close();
        $conn->close();
    }
?>