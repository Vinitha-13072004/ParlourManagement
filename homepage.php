<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlamBue</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <img src="image/logo.jpg" alt="hair style">
                
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#contact ">Contact Us</a></li>
                    <li><a href="#reviews">Reviews</a></li>
                    <li><a href="#nearby-parlors">Nearby Parlors</a></li>
                    <li><a href="login.php" class="btn">Login</a></li> <!-- Corrected -->
                    <li><a href="registration.php" class="btn">Register</a></li> <!-- Corrected -->
                </div>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h2 style="text-align:left">Transform and shine at GlamBue</h2>
            <h3 style="text-align:left">Where your beauty and confidence blossom with every visit</h3>
           
        </div>
    </section>
    

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <h2>Our Services</h2>
            <div class="services-grid">
                <div class="service-item">
                    <h3>Hair</h3>
                    <p>Professional haircuts, styling.</p>
                </div>
                <div class="service-item">
                    <h3>Makeup</h3>
                    <p>Bridal makeup, event makeup, and more.</p>
                </div>
                <div class="service-item">
                    <h3>Skincare</h3>
                    <p>Facials.</p>
                </div>
                <div class="service-item">
                    <h3>Nails</h3>
                    <p>Manicures, pedicures, and nail art.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="about">
        <div class="container">
            <h2>About Us</h2>
            <p>Welcome to Glambue, where we believe in enhancing your natural beauty with professional care and attention to detail.</p>
            <p>Our team of experts is dedicated to providing the highest quality services in a relaxing and luxurious environment.</p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery">
        <div class="container">
            <h2>Our Work</h2>
            <div class="gallery-grid">
                <img src="image/gal1.jpg" alt="threading">
                <img src="image/gal2.jpg" alt="haircut">
                <img src="image/gal3.jpg" alt="pedicurer">
                <img src="image/gal4.jpg" alt="bridal makeover">
            </div>
        </div>
    </section>
    
    <!-- Reviews Section -->
    <section id="reviews" class="reviews">
        <div class="container">
            <h2>Customer Reviews</h2>
            <div class="reviews-grid">
                <div class="review-item">
                    <p>"Amazing service! I always leave feeling refreshed and beautiful."</p>
                    <span>- Anie</span>
                </div>
                <div class="review-item">
                    <p>"The best beauty parlor in town! Highly recommend."</p>
                    <span>- Krithi</span>
                </div>
                <div class="review-item">
                    <p>"Exceptional quality and friendly staff. Loved my experience!"</p>
                    <span>- Sarah </span>
                </div>
                <div class="review-item">
                    <p>"A wonderful place to relax and get pampered. Five stars!"</p>
                    <span>- Emily </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Nearby parlor -->
    <section id="nearby-parlors" class="parlors">
    <div class="container">
        <h3>Minnus Beauty Parlor</h3>
        <p>Main Service: Haircut and bridal Makeup</p>
        <p>Location: Main Road Near SBI Bank, Peerumade</p>
    </div>

    <div class="parlor">
        <h3>Colomia Beauty Parlor</h3>
        <p>Main Service: HairStyling and Event Makeup</p>
        <p>Location: 12, MG Road, Kuttikanam, Idukki 685531, India</p>
    </div>

    <div class="parlor">
        <h3>Femina Beauty Parlor</h3>
        <p>Main Service: Saree Drapping and Bridal Packages</p>
        <p>Location: 2nd Floor, Kuttikanam</p>
    </div>

    <div class="parlor">
        <h3>Laya Beauty Parlor</h3>
        <p>Main Service: Bridal Makeup and Haircut</p>
        <p>Location:GHS Main Road Mundakayam</p>
    </div>
</div>
</section>


    <!-- Footer -->
    <footer>
        <!-- Other Sections of Your Page -->

<!-- Contact Us Section -->
<section id="contact" class="contact">
    <div class="container">
        <h2>Contact Us</h2>
            <p>If you have any questions, feel free to reach out to us:</p>
            <p>Phone: 8590916553</p>
            <p>Email: glambue@gmail.com</p>
            <p>Address: 123 Beauty Lane, GlamCity, BC 54321</p>
    </div>
</section>
</footer>

<!-- Footer -->
<footer>
    <div class="container footer-content">
        <!-- Footer content here -->
        <p>&copy; 2024 Glambue. All rights reserved.</p>
    </div>

    <div class="container footer-content">
            <div class="contact-info">
                <p>Phone: 8590916553</p>
                <p>Email: galmbue@gmail.com</p>
            </div>
</footer>

    <script src="scripts.js"></script>

    <style>
        /* Import Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

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
        
        }

        /* Container */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header Styles */
        header {
            background: linear-gradient(thistle,white); 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 100px; /* Adjust the width as needed */
            height: 50px; /* Adjust the height as needed */
            object-fit: contain; /* Ensures the image is not distorted */
            margin-right: 10px; /* Space between image and text */
            border-radius: 50%; /* Make the image circular if desired */
        }

        

        nav ul {
            list-style: none;
            display: flex;
            align-items: center;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: black;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: maroon;
        }

        /* Hero Section */
        .hero {
            height: 100vh; /* Full viewport height */
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("image/fin.jpg"); /* Add a dark transparent overlay on the background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: thistle;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .hero h2 {
            font-size: 40px;
            margin-top: -200px;
            text-shadow: 1px 1px 1px ;    
        }

        .hero h3 {
            font-size: 30px;
            margin-top: -10px;
            text-shadow: 1px 1px 1px;
        }

   
        .hero .btn:hover {
            background-color:thistle;
        }

        /* Services Section */
        .services {
            padding: 50px 0;
            background-color:white;
            text-align: center;
        }

        .services h2 {
            font-size: 36px;
            margin-bottom: 50px;
            color: black;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .service-item {
            background-color:thistle;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .service-item:hover {
            transform: translateY(-10px);
        }

        .service-item h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: black;
        }

        .service-item p {
            color: black;
        }

        /* About Us Section */
        .about {
            padding: 50px 0;
            background-color:white;
            text-align: center;
        }

        .about h2 {
            font-size: 36px;
            margin-bottom: 30px;
        }

        .about p {
            color: #000000;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Gallery Section */
        .gallery {
            padding: 50px 0;
            background-color:thistle;
            text-align: center;
        }

        .gallery h2 {
            font-size: 36px;
            margin-bottom: 30px;
            color: black;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .gallery-grid img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
        .gallery-grid img {
            width: 100%;
            height: auto; /* Ensures the height is automatically adjusted based on the width */
            max-height: 300px; /* Set a maximum height to ensure consistency */
            object-fit: contain; /* Ensures the image is not cropped or distorted */
            border-radius: 10px;
            display: block;
            margin: 0 auto; /* Centers the image */
}


        /* Reviews Section */
        .reviews {
            padding: 50px 0;
            background-color:white;
            text-align: center;
        }

        .reviews h2 {
            font-size: 36px;
            margin-bottom: 30px;
        }

        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .review-item {
            background-color:thistle;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .review-item:hover {
            transform: translateY(-10px);
        }

        .review-item p {
            font-size: 16px;
            color:black;
            margin-bottom: 10px;
        }

        .review-item span {
            font-size: 14px;
            color: #000000;
        }

        /* Nearby Parlors Section */
        .parlors {
            padding: 50px 0;
            background-color:thistle;
            text-align: center;
        }

        
        /* Footer */
        .contact {
            background-color: white;
            color: black;
            padding: 100px 0;
            text-align: center;
            margin-bottom:10px;
            background-color:white
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-top:10px;
            background-color:thistle;
        }

        .contact-info p {
            margin-bottom: 10px;
        }


        .footer-bottom {
            margin-top: 20px;
            font-size: 14px;

        }

    </style>
</body>
</html>
