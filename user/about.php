<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Parlors - GlamBue</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header -->
    <header>
    <section class="hero">
        <div class="container">
            <h3>About</h3>
        </div>
    </section>
    </header>

    <!-- About Parlors Section -->
    <section id="about-parlors" class="about-parlors">
        <div class="container">
            <div class="parlors-grid">
                <!-- Parlor 1 -->
                <div class="parlor-item">
                    <h3>Minnus Beauty Parlor</h3>
                    <img src="image/parlor1.jpg" alt="Minnus Beauty Parlor">
                    <p><strong>Location:</strong>  Main Road Near SBI Bank, Peerumade</p>
                    <p><strong>Years in Business:</strong> 2 years</p>
                    <p><strong>Specialty:</strong> Minnus Beauty Parlor is renowned for its expertise in haircut and bridal makeup . With a decade of experience, the parlor has built a loyal clientele who trust Minnus for its quality and attention to detail.</p>
                    <p><strong>Mission:</strong> To enhance the natural beauty of our clients with personalized and exceptional beauty services.</p>
                </div>

                <!-- Parlor 2 -->
                <div class="parlor-item">
                    <h3>Colomia Beauty Parlor</h3>
                    <img src="image/parlor2.jpg" alt="Colomia Beauty Parlor">
                    <p><strong>Location:</strong> 12, MG Road, Kuttikanam, Idukki 685531, India</p>
                    <p><strong>Years in Business:</strong> 3 years</p>
                    <p><strong>Specialty:</strong> Colomia Beauty Parlor specializes in  hair styling and event makeup. The parlor is a favorite among celebrities and socialites for its trend-setting looks and impeccable service.</p>
                    <p><strong>Mission:</strong> To create stylish and sophisticated beauty experiences that leave our clients feeling glamorous and confident.</p>
                </div>

                <!-- Parlor 3 -->
                <div class="parlor-item">
                    <h3>Femina Beauty Parlor</h3>
                    <img src="image/parlor3.jpg" alt="Femina Beauty Parlor">
                    <p><strong>Location:</strong>  2nd Floor, Kuttikanam</p>
                    <p><strong>Years in Business:</strong> 2 years</p>
                    <p><strong>Specialty:</strong> Femina Beauty Parlor is well-known for its saree drapping and bridal packages. With over a decade of experience, Femina has become a trusted name for brides-to-be.</p>
                    <p><strong>Mission:</strong> To provide exquisite beauty services that make every bride’s dream look a reality.</p>
                </div>

                <!-- Parlor 4 -->
                <div class="parlor-item">
                    <h3>Luna Beauty Parlor</h3>
                    <img src="image/parlor4.jpg" alt="Luna Beauty Parlor">
                    <p><strong>Location:</strong> GHS Main Road Mundakayam</p>
                    <p><strong>Years in Business:</strong> 4 years</p>
                    <p><strong>Specialty:</strong> Luna Beauty Parlor is famous for its precision haircuts and comprehensive bridal makeup. The parlor’s modern approach and skilled stylists attract clients seeking contemporary and elegant styles.</p>
                    <p><strong>Mission:</strong> To provide cutting-edge beauty services that help our clients shine inside and out.</p>
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
    body {
    margin:0;
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

/* About Parlors Section */
.about-parlors {
    padding: 60px 0;
    background-color: #e5e5e5;
}
.parlors-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr); /* Each parlor takes up full width */
    gap: 20px;
}
.parlor-item {
    background: #f7f7f7;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}
.parlor-item img {
    width: auto;
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 15px;
    object-fit: contain; /* Ensures the entire image fits within the container */
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
