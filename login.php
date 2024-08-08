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
            justify-content: center;
            align-items: center;
            background-image: url('image/bg1.jpeg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .login-container {
            padding: 30px;
            border-radius: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            width: 300px;
            text-align: center;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.453);
            background-color: rgba(0, 0, 0, 0.453);
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

        button {
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

        button:hover {
            background-color: #6a9194;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>LOGIN</h2>
        <form id="loginForm" action="/login" method="post">
            <div class="input-group">
                <input type="text" id="username" name="username" required maxlength="15">
                <label for="username">Username</label>
                <div id="usernameError" class="error-message"></div>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" required maxlength="8">
                <label for="password">Password</label>
                <div id="passwordError" class="error-message"></div>
            </div>
            <div class="input-group forgot">
                <a class="forgotlink" href="#">Forgot password?</a>
            </div>
            <button type="submit">Login</button>
            <a href="registration.html"><span style="color: white">Create a new account</span></a>
        </form>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
            let isValid = true;
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            const usernameError = document.getElementById('usernameError');
            const passwordError = document.getElementById('passwordError');

            usernameError.textContent = '';
            passwordError.textContent = '';

            // Username validation
            if (username.length < 5 || username.length > 15) {
                usernameError.textContent = 'Username must be between 5 and 15 characters long.';
                isValid = false;
            }

            if (!/^[a-zA-Z0-9]+$/.test(username)) {
                usernameError.textContent = 'Username can only contain letters and numbers.';
                isValid = false;
            }

            // Password validation
            if (password.length !== 8) {
                passwordError.textContent = 'Password must be exactly 8 characters long.';
                isValid = false;
            }

            if (!/[A-Z]/.test(password)) {
                passwordError.textContent = 'Password must contain at least one uppercase letter.';
                isValid = false;
            }

            if (!/[a-z]/.test(password)) {
                passwordError.textContent = 'Password must contain at least one lowercase letter.';
                isValid = false;
            }

            if (!/[0-9]/.test(password)) {
                passwordError.textContent = 'Password must contain at least one number.';
                isValid = false;
            }

            if (!/[!@#\$%\^&\*]/.test(password)) {
                passwordError.textContent = 'Password must contain at least one special character.';
                isValid = false;
            }

            if (!isValid) {
                return; // Stop the function if validation fails
            }

            // Check if user exists
            fetch('/checkUserExists', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ username: username })
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    alert('User already exists. Please log in.');
                } else {
                    document.getElementById('loginForm').submit();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Prevent further input once the character limit is reached
        document.getElementById('username').addEventListener('input', function() {
            if (this.value.length > 15) {
                this.value = this.value.slice(0, 15);
            }
        });

        document.getElementById('password').addEventListener('input', function() {
            if (this.value.length > 8) {
                this.value = this.value.slice(0, 8);
            }
        });
    </script>
    </body>
</html>
