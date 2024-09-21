<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - GlamBue</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header -->
    <header>
    <section class="hero">
        <div class="container">
            <h3>Contact</h3>
        </div>
    </section>
    </header>
    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            
            <div class="parlors-grid">
                <!-- Parlor 1 -->
                <div class="parlor-item">
                    <h3>Minnus Beauty Parlor</h3>
                    <p><strong>Phone:</strong> 9923490383</p>
                    <p><strong>Email:</strong> minnusbeauty@gmail.com</p>
                    <p><strong>Address:</strong> Main Road Near SBI Bank, Peerumade</p>
                    <p><strong>Hours:</strong> Mon - Sat, 9:00 AM - 8:00 PM</p>
                </div>

                <!-- Parlor 2 -->
                <div class="parlor-item">
                    <h3>Colomia Beauty Parlor</h3>
                    <p><strong>Phone:</strong>8898769043</p>
                    <p><strong>Email:</strong> colomiabeauty@gmail.com</p>
                    <p><strong>Address:</strong>  12, MG Road, Kuttikanam, Idukki 685531, India</p>
                    <p><strong>Hours:</strong> Mon - Sat, 10:00 AM - 7:00 PM</p>
                </div>

                <!-- Parlor 3 -->
                <div class="parlor-item">
                    <h3>Femina Beauty Parlor</h3>
                    <p><strong>Phone:</strong> 8768302456</p>
                    <p><strong>Email:</strong> feminabeauty@gmail.com</p>
                    <p><strong>Address:</strong> 2nd Floor, Kuttikanam</p>
                    <p><strong>Hours:</strong> Mon - Fri, 9:00 AM - 9:00 PM</p>
                </div>

                <!-- Parlor 4 -->
                <div class="parlor-item">
                    <h3>Luna Beauty Parlor</h3>
                    <p><strong>Phone:</strong>8568790334</p>
                    <p><strong>Email:</strong> lunabeauty@gmail.com</p>
                    <p><strong>Address:</strong> GHS Main Road Mundakayam</p>
                    <p><strong>Hours:</strong> Tue - Sun, 10:00 AM - 8:00 PM</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <!-- Your footer code -->
    </footer>
</body>
<style>
/* Reset some basic styles */
body{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body h3{
    text-align:center;
    font-size:100px;
    color:thistle;
}

.hero {
            height: 100vh; /* Full viewport height */
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("image/userhp.jpg"); /* Add a dark transparent overlay on the background image */
            background-size: cover;
            background-repeat: no-repeat;
            color: thistle;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
    
        }

/* Contact Section */
.contact {
    padding: 60px 0;
    background-color: #f4f4f4;
    margin: 0; /* Remove any default margins */
}

.container {
    width: 100%;
    max-width: 1200px; /* Or whatever width you prefer */
    margin: 0 auto; /* Center the container */
    padding: 0 20px; /* Add some padding for content spacing */
}

.parlors-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.parlor-item {
    background: #eaeaea;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

.parlor-item h3 {
    font-size: 1.8em;
    color: #280a22;
    margin-bottom: 15px;
}

.parlor-item p {
    font-size: 1em;
    color: #333;
    margin-bottom: 10px;
}
</style>
</html>
