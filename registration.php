<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Company Signup</title>
    <style>
    * {
        padding: 0;
        margin: 0;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        box-sizing: border-box;
    }
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        color: #000000;
        background-color: darkslategrey;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 100%;
    }
    h2 {
        font-size: 25px;
        text-align: center;
        margin: 50px;
        color: grey;
    }
    .main-container{
        position: relative;
        height: 80%;
        width: 60%;
        box-shadow: 10px 0px 20px #000000;
    }
    .main-container img{
        position: absolute;
        height: 100%;
        width: 40%;
        left: 0;
        object-fit: cover;
        min-width: 100px;
    }
    .container{
        position: absolute;
        right: 0;
        background-color: #3a0606f6;
        width: 60%;
        min-width: 300px;
        height: 100%;
        padding-inline: 10%;
        padding-block: 20px;
        margin: 0;
        overflow: auto;
        
    }
    .container::-webkit-scrollbar{
        display: none;
    }
        
    .container .form{
        width:60%;
    }
    .input-layer {
        margin-bottom: 45px;
        height: 50px;
        position: relative;
    }
    .input-layer input {
        height: 30px;
        width: 100%;
        border: none;
        outline: none;
        border-bottom: 1px solid #c0c0c0;;
        font-size: 16px;
        padding: 5px 0;
        background: none;
        color: #ffffff;
    } 
    .input-layer label {
        position: absolute;
        top: 20%;
        left: 0px;
        transform: translateY(-50%);
        color: #c0c0c0;
        font-size: 22px;
        font-weight: 1;
        pointer-events: none;
        transition: all 0.3s ease;
    }
    .input-layer input:focus ~ label,
    .input-layer input:not(:placeholder-shown) ~ label {
        top: -20px;
        left: 0;
        color: #ffffff; 
    }
    .input-layer input:focus{
        border-bottom: #3a0606f6 2px solid;
    }
    
    .input-layer input[type=submit] {
        position: absolute;
        color: maroon(242, 245, 255);
        width: 100%;
        height: 40px;
        border: 1px  maroon(47, 95, 255);
        background-color:  black;
        font-weight: 600;
        border-radius: 5px;
    }
    .input-layer input[type=submit]:hover {

        color: white;
        border-color: #3a0606f6;
    }
    select{
        height: 40px;
        width: 100%;
        background-color:#3a0606f6;
        outline: none;
        color:#ffffff;
        border-color: #d8d8d85b;
        border-style:inset;
        border-radius: 15px;
        align-items: center;
        font-size: 15px;
    }
    section option{
        color: #3a0606f6;
    }
    .input-layer .fname{
        width: 48%;
        position: absolute;
        left: 0;
    }
    .input-layer .sname{
        width: 48%;
        position: absolute;
        right: 0;
    }
    .container input[type='radio']{
        position: relative;
        width: 120px;
        height: 40px;
        align-items: center;
        margin: 10px;
        outline: none;
        background: #000000;
    }
    .selection{
        height: 100px;
        justify-content: center;
        display: flex;
    }
    .checkbox{
        height: 40px;
        width: 300px;
        background-color: #ffffff55;
        border: 1px solid;
        box-shadow: 2px 4px 4px inset;
        overflow: hidden;
        border-radius: 20px;

    }
    #checkbox-toggle{
        display: none;
    }
    .checkbox .toggle{
        width: 150px;
        height: 40px;
        transform: skewX(30deg);
        left: -10px;
        background-color: #f9f1f850;
        position: absolute;
        cursor: pointer;
        transition: all .5s ease;
    }
    .checkbox .slide{
        width: 300px;
        height: 40px;
        display: flex;
        align-items:center ;
        justify-content: space-around;
        cursor: pointer;
        position: relative;
    }
    .checkbox .slide .text{
        font-size: 16px;
        font-weight: 700;
        z-index: 100;
        cursor: pointer;

    }
    .check:checked + .checkbox .slide .toggle{
        transform: translateX(170px) skewX(-30deg);
    }
    </style>
</head>
<body>
    <div class="main-container">
        <img src="image/regbg.jpg" alt="">
    <div class="container">
       <h2>WELCOME TO <span style="color:darkslategrey;">GlamBUE</span></h2> 
    <div class="selection">
        <input type="checkbox" id="checkbox-toggle" class="check">
        <div class="checkbox">
            <label for="checkbox-toggle" class="slide">
                <label for="checkbox-toggle" class="toggle"></label>
                <label for="checkbox-toggle" class="text">HOLDER</label>
                <label for="checkbox-toggle" class="text">USER</label>
            </label>
        </div>
    </div>

       <div class="holderform" id="holderform">
            <form action="registrationValidation.php" method="post" onsubmit="return validateForm()">
                <div class="input-layer">
                    <input type="text" id="parlourname" name="parlourname" placeholder=" ">
                    <label for="parlourname">Parlour Name</label>
                </div>
            
                <div class="input-layer">
                    <input type="text" id="holdername" name="holderform" placeholder=" ">
                    <label for="holdername">Holder Name</label>
                </div>
                <div class="input-layer">
                    <input type="email" id="email" name="email" placeholder=" ">
                    <label for="email">Email</label>
                </div>
                <div class="input-layer">
                    <input type="text" id="phonenum" name="phonenum" placeholder=" ">
                    <label for="phonenum">Phone Number</label>
                </div>
                <div class="input-layer">
                    <input type="text" id="city" name="city" placeholder=" ">
                    <label for="city">City</label>
                </div>
                    <div class="input-layer">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>

        <div class="userform" id="userform" style="display: none;">
             <form action="registrationValidation.php" method="post" onsubmit="return validateForm()">
                 <div class="input-layer">
                    <div class="fname">
                        <input type="text" id="userfname" name="userfname" placeholder=" ">
                        <label for="userfname">First name</label>
                    </div>
                    <div class="sname">
                        <input type="text" id="usersname" name="usersname" placeholder=" ">
                        <label for="usersname">Last Name</label>
                    </div>
                 </div>
                 
                <div class="input-layer">
                    <input type="text" id="usercity" name="usercity" placeholder=" ">
                    <label for="usercity">City</label>
                </div>
                <div class="input-layer">
                    <input type="text" id="phonenum" name="phonenum" placeholder=" ">
                    <label for="phonenum">Phone Number</label>
                </div>
                <div class="input-layer">
                    <input type="email" id="email" name="email" placeholder=" ">
                    <label for="email">Email</label>
                </div>
                 <div class="input-layer">
                     <input type="password" id="password" name="password" placeholder=" ">
                     <label for="password">Password</label>
                 </div>
                 
                 <div class="input-layer">
                     <input type="password" id="cpassword" name="cpassword" placeholder=" ">
                     <label for="cpassword">Confirm password</label>
                 </div>
                 <div class="input-layer">
                     <input type="submit" value="Submit">
                 </div>
             </form>
         </div>
    </div>
    </div>
    

    <script>
        function validateForm() {
            // Get form elements
            var companyName = document.getElementById("companyname").value;
            var regId = document.getElementById("regid").value;
            var contactPerson = document.getElementById("contactperson").value;
            var email = document.getElementById("email").value;
            var phoneNum = document.getElementById("phonenum").value;

            // Regular expressions for validation
            var regIdPattern = /^[A-Za-z0-9]{6,}$/;
            var phoneNumPattern = /^[0-9]{10}$/;

            // Validate Company Name
            if (companyName === "") {
                alert("Company Name is required.");
                return false;
            }

            // Validate Registration ID
            if (!regIdPattern.test(regId)) {
                alert("Registration ID should be alphanumeric and at least 6 characters long.");
                return false;
            }

            // Validate Contact Person
            if (contactPerson === "") {
                alert("Contact Person is required.");
                return false;
            }

            // Validate Email
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Validate Phone Number
            if (!phoneNumPattern.test(phoneNum)) {
                alert("Phone number should be 10 digits long.");
                return false;
            }

            // If all validations pass
            return true;
        }
        const toggleCheckbox = document.getElementById('checkbox-toggle');
        const userContainer = document.getElementById('userform');
        const registrationContainer = document.getElementById('companyform');

        toggleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                userContainer.style.display = 'block';
                registrationContainer.style.display = 'none';
            } else {
                userContainer.style.display = 'none';
                registrationContainer.style.display = 'block';
            }
        });

        // Initial state
        registrationContainer.style.display = 'block';
    </script>
</body>
</html> 