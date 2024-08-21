<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Parlour Login</title>
    <link rel="stylesheet" href="styles.css">
    
    <style>
   body {
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    background-image: url(image/login1.PNG);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}

.login-container {
    position:absolute;
    left:20%;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 3px 10px inset;
    background-color: rgba(255, 255, 255, 0.10);
    width: 300px;
    text-align: center;
    border: 1px solid #Aa6c39;
    backdrop-filter: blur(10px);
}


        .login-container h2 {
            margin-bottom: 20px;
            color: #ffffff;
            font-family: 'Playfair Display', serif;
            font-size: 24px;
        }

        .input-group {
            position: relative;
            margin-bottom: 30px;
            text-align: left;
        }

        .input-group input {
            width: 100%;
            padding: 10px 0;
            border: none;
            border-bottom: 2px solid #ddd;
            background: transparent;
            outline: none;
            transition: border-color 0.3s, padding 0.3s;
            font-size: 16px;
            color: #ffffff;
        }

        .input-group label {
            position: absolute;
            top: 10px;
            left: 0;
            font-size: 16px;
            color: #f4f1f1;
            transition: 0.3s;
            pointer-events: none;
        }

        .input-group input:focus ~ label,
        .input-group input:valid ~ label {
            top: -15px;
            color: #000000;
        }

        .input-group.forgot {
            display: flex;
            justify-content: center;
        }

        .forgotlink {
            text-decoration: none;
            text-align: center;
            color: white;
        }

        input[type=submit] {
            width: 100%;
            padding: 10px;
            background-color: #ff6f61;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type=submit]:hover {
            background-color: #6a9194;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            
        }
        .registering{
            color:white;
            text-decoration:none;
        }
        .errordiv{
        height: 40px;
        align-items:center;
        display:flex;
        position: relative;
    }
    .errordiv p{
        color:red;
        position: absolute;
        top:20px
    }
    .errordiv .pos{
        color:green;
        position: absolute;
        top:20px
    }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>LOGIN</h2>
        <div class="errordiv">
                    <?php
                        if(isset($_GET['error'])){
                            $error_message=htmlspecialchars($_GET['error']);
                            echo "<p>{$error_message}</p>";
                            unset($_GET['error']);
                       } 
                       if(isset($_GET['message'])){
                            echo "<p class='pos'>{$_GET['message']}</p>";
                            unset($_GET['message']);
                        } 
                    ?>
                </div>
        <form id="loginForm" action="loginValidation.php" method="post" onsubmit="return loginvalidation()">
            <div class="input-group">
                <input type="text" id="email" name="email" required maxlength="15">
                <label for="email">Username</label>
                <div id="email" class="error-message"></div>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" required maxlength="8">
                <label for="password">Password</label>
                <div id="passwordError" class="error-message"></div>
            </div>
            <div class="input-group forgot">
                <a class="forgotlink" href="#">Forgot password?</a>
            </div>
            <input type="submit" value="LOGIN">
            <a class="registering" href="registration.php">Create a new account</a>
        </form>
    </div>

    <script>
         function loginValidation() {
            // Clear previous error messages
            document.getElementById("usernameError").innerText = "";
            document.getElementById("passwordError").innerText = "";

            // Get values from the input fields
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;
            let valid = true;

            // Basic validation for username
            if (username.length < 3) {
                document.getElementById("usernameError").innerText = "Username must be at least 3 characters long.";
                valid = false;
            }

            // Basic validation for password
            if (password.length < 6) {
                document.getElementById("passwordError").innerText = "Password must be at least 6 characters long.";
                valid = false;
            }
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{6,}$/;
            if (!passwordPattern.test(password)) {
                document.getElementById("passwordError").innerText = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
                valid = false;
            }

            // Return the validation result
            return valid;
        }
    </script>
    </body>
</html>
