<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parlorname = $_POST['parlorname'];
    $holdername = $_POST['holdername'];
    $email = $_POST['holderemail'];
    $phonenum = $_POST['holderphonenum'];
    $city = $_POST['holdercity'];
    $account_password=$_POST['holderpassword'];
    $account_type="holder";
    

    // Data validation (simple example)
    if (empty($parlorname) || empty($holdername) || empty($email) || empty($phonenum) || empty($city)) {
        echo "All fields are required.";
        exit;
    }

    // Check if the email already exists
    $acc_check = $conn->prepare("SELECT * FROM account_login WHERE account_email= ? ");
    $acc_check->bind_param("s",$email);
    $acc_check->execute();
    $acc_check->store_result();
    if($acc_check->num_rows>0){
        echo "<script> alert('This email already registered.') </script>";
        $acc_check->close();
    }

    // Insert data into the database
    else{
         
        // Inserting data into Table

        // $hashed_password = password_hash($account_password, PASSWORD_BCRYPT);   
        $stmt = $conn->prepare("INSERT INTO holder_details (parlorname,holdername,account_email,phonenumber,city) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss",$parlorname,$holdername,$email,$phonenum,$city);
        $inst=$conn->prepare("INSERT INTO account_login (account_email,account_password,account_type) VALUES(?,?,?)");
        $inst->bind_param("sss",$email,$account_password,$account_type);
        if ( $inst->execute()) {
            header("location:login.php?message=Account created successfully");
            $stmt->execute();
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
    }
}

?>
