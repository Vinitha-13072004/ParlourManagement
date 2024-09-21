<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlamBue - Owner Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <img src="image/logo.jpg" alt="GlamBue">
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="holderhomepage.php">Home</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="about.php">Parlors</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h2 style="text-align:center">Welcome to GlamBue, where we enhance your beauty and provide a luxurious experience</h2>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="parlors" class="parlors">
        <div class="container">
            <p>Welcome to GlamBue, where we believe in enhancing your natural beauty with professional care and attention to detail.</p>
            <p>Our team of experts is dedicated to providing the highest quality services in a relaxing and luxurious environment.</p>
        </div>
    </section>


    <!-- Dashboard Section -->
    <section id="dashboard" class="dashboard">
        <div class="container">
            <h2>Owner Dashboard</h2>
            <div class="dashboard-grid">
                <a href="manageappointments.php" class="dashboard-item">Manage Appointments</a>
                <a href="manageservices.php" class="dashboard-item">Manage Services</a>
                <a href="viewreports.php" class="dashboard-item">View Reports</a>
                <a href="managestaff.php" class="dashboard-item">Manage Staff</a>
                <a href="settings.php" class="dashboard-item">Settings</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 GlamBue. All rights reserved.</p>
        </div>
    </footer>
</body>

<style>
<style>
/* General Styles */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
body {
    font-family: 'Roboto', sans-serif;
    line-height: 1.6;
    scroll-behavior: smooth;
    background-color: #1a1a2e;
    color: #f0f0f0;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 5px;
}

/* Header Styles */
header {
    background: linear-gradient(to right, #0f3460, #16213e);
    color: #f0f0f0;
    padding: 5px 0;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    position: sticky;
    top: 0;
    z-index: 1000;
}
.logo img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}
nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.nav-links {
    list-style: none;
    display: flex;
}
.nav-links li {
    margin-left: 20px;
}
.nav-links a {
    color: #e94560;
    text-decoration: none;
    font-weight: 700;
}
.nav-links a:hover {
    color: #00adb5;
}

/* Hero Section */
.hero {
    height: 100vh;
    background-image: url("image/homepg2.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: #f0f0f0;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
    background-blend-mode: overlay;
    background-color: rgba(0, 0, 0, 0.5);
}

/* Dashboard Section */
.dashboard {
    padding: 60px 0;
    background-color: #16213e;
    text-align: center;
    border-top: 4px solid #e94560;
}
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}
.dashboard-item {
    background-color: #0f3460;
    color: #f0f0f0;
    padding: 20px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 700;
    transition: background-color 0.3s, transform 0.3s;
}
.dashboard-item:hover {
    background-color: #e94560;
    transform: scale(1.05);
}

/* About Us Section */
.parlors {
    padding: 60px 0;
    text-align: center;
}
.parlors p {
    max-width: 800px;
    margin: 0 auto;
    font-size: 1.2em;
    color: #f0f0f0;
    line-height: 1.7;
}


/* Footer */
footer {
    background-color: #16213e;
    color: #f0f0f0;
    padding: 20px 0;
    text-align: center;
    border-top: 4px solid #e94560;
}
footer p {
    margin-bottom: 10px;
}
footer .social-media {
    display: flex;
    justify-content: center;
    gap: 20px;
}
footer .social-media a {
    color: #f0f0f0;
}
footer .social-media a:hover {
    color: #e94560;
}

</style>

</html>
