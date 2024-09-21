<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Registration</title>
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
        background-color:white;
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
        border-bottom: 1px solid #c0c0c0;
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
        color: rgb(242, 245, 255);
        width: 100%;
        height: 40px;
        border: 1px solid maroon;
        background-color: black;
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
            <form action="holderregistration.php" method="post" onsubmit="return holderValidation()">
                <div class="input-layer">
                    <input type="text" id="parlorname" name="parlorname" placeholder=" ">
                    <label for="parlorname">Parlour Name</label>
                </div>
            
                <div class="input-layer">
                    <input type="text" id="holdername" name="holdername" placeholder=" ">
                    <label for="holdername">Holder Name</label>
                </div>
                <div class="input-layer">
                    <input type="text" id="holderemail" name="holderemail" placeholder=" ">
                    <label for="holderemail">Email</label>
                </div>
                <div class="input-layer">
                    <input type="text" id="holderphonenum" name="holderphonenum" placeholder=" ">
                    <label for="holderphonenum">Phone Number</label>
                </div>
               
                <div class="input-group">
                    <select id="city" name="city" required>
                    <option value="" disabled selected>City</option>
                    <option value="pambanr">Pambanr</option>
                    <option value="periyar">Periyar</option>
                    <option value="kuttikanam">Kuttikanam</option>
                    <option value="mundakayam">Mundakayam</option>
                </div>
                </select>
                <div class="input-layer">
                     <input type="password" id="holderpassword" name="holderpassword" placeholder=" ">
                     <label for="password">Password</label>
                 </div>
                 <div class="input-layer">
                     <input type="password" id="holderconfirmpassword" name="holderconfirmpassword" placeholder=" ">
                     <label for="confirmpassword">Confirm Password</label>
                 </div>
                <div class="input-layer">
                    <input type="submit" value="Register Now">
                </div>
            </form>
       </div>

       <div class="userform" id="userform" style="display: none;">
        <form action="useregistration.php" method="post" onsubmit="return userValidation()">
            <div class="input-layer">
                <input type="text" id="username" name="username" placeholder=" ">
                <label for="username">Name</label>
            </div>
            <div class="input-layer">
                <input type="text" id="useremail" name="useremail" placeholder=" ">
                <label for="useremail">Email</label>
            </div>
            <div class="input-layer">
                <input type="text" id="userphonenum" name="userphonenum" placeholder=" ">
                <label for="userphonenum">Phone Number</label>
            </div>
            <div class="input-group">
                <select id="city" name="city" required>
                <option value="" disabled selected>City</option>
                <option value="pambanar">Pambanar</option>
                <option value="periyar">Periyar</option>
                <option value="kuttikanam">Kuttikanam</option>
                <option value="mundakayam">Mundakayam</option>
            </select>
            <div class="input-layer">
                 <input type="password" id="userpassword" name="userpassword" placeholder=" ">
                 <label for="userpassword">Password</label>
             </div>
             <div class="input-layer">
                 <input type="password" id="userconfirmpassword" name="userconfirmpassword" placeholder=" ">
                 <label for="userconfirmpassword">Confirm Password</label>
             </div>
            <div class="input-layer">
                <input type="submit" value="Register Now">
            </div>
        </form>
       </div>
    </div>
    </div>
    <script>
        document.querySelector('#checkbox-toggle').addEventListener('click', function() {
            var checkbox = document.querySelector('.check');
            var userForm = document.getElementById('userform');
            var holderForm = document.getElementById('holderform');
            
            if (checkbox.checked) {
                userForm.style.display = 'block';
                holderForm.style.display = 'none';
            } else {
                userForm.style.display = 'none';
                holderForm.style.display = 'block';
            }
        });
        
        function holderValidation() {
            var parlorname = document.getElementById('parlorname').value.trim();
            var holdername = document.getElementById('holdername').value.trim();
            var holderemail = document.getElementById('holderemail').value.trim();
            var holderphonenum = document.getElementById('holderphonenum').value.trim();
            var holdercity = document.getElementById('holdercity').value.trim();
            var holderpassword = document.getElementById('holderpassword').value.trim();
            var holderconfirmpassword = document.getElementById('holderconfirmpassword').value.trim();

            if (parlorname === "" || holdername === "" || holderemail === "" || holderphonenum === "" || holdercity === "" || holderpassword === "" || holderconfirmpassword === "") {
                alert("All fields must be filled out");
                return false;
            }
            
            if (holderpassword !== holderconfirmpassword) {
                alert("Passwords do not match");
                return false;
            }
            
            return true;
        }

        function userValidation() {
            var username = document.getElementById('username').value.trim();
            var email = document.getElementById('useremail').value.trim();
            var phonenum = document.getElementById('userphonenum').value.trim();
            var city = document.getElementById('usercity').value.trim();
            var password = document.getElementById('userpassword').value.trim();
            var confirmpassword = document.getElementById('userconfirmpassword').value.trim();

            if (username === "" || email === "" || phonenum === "" || city === "" || password === "" || confirmpassword === "") {
                alert("All fields must be filled out");
                return false;
            }
            
            if (password !== confirmpassword) {
                alert("Passwords do not match");
                return false;
            }
            
            return true;
        }
    </script>
</body>
</html>
