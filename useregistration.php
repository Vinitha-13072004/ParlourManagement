<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Get the user input
    $user_name = trim($_POST['username']);
    $city = trim($_POST['usercity']);
    $phonenum = trim($_POST['userphonenum']);
    $email = trim($_POST['useremail']);
    $userpassword= trim($_POST['userpassword']);
    $account_type="user";
    


    //include Connection
    include 'connection.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    $acc_check = $conn->prepare("SELECT * FROM account_login WHERE account_email= ? ");
    $acc_check->bind_param("s",$email);
    $acc_check->execute();  
    $acc_check->store_result();
    if($acc_check->num_rows>0){
        echo "<script> alert('This email already registered.') </script>";
        $acc_check->close();
    }
   
    
    else{
        // $hashed_password = password_hash($studentpassword, PASSWORD_BCRYPT);   
        $stmt = $conn->prepare("INSERT INTO user_details (username,City,phonenumber,account_email) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$user_name,$city,$phonenum,$email);
        $inst=$conn->prepare("INSERT INTO account_login (account_email,account_password,account_type) VALUES(?,?,?)");
        $inst->bind_param("sss",$email,$userpassword,$account_type);


        if ( $inst->execute()) {
            $stmt->execute();
            header("location:login.php?message=Account created successfully");
            
        } else {
            echo "
            <script>
                alert('Error:' . $stmt->error .$inst->error);
            </script>;
            ";
        }


        $stmt->close();
        $inst->close();
    }
    $conn->close(); 
} 

?>