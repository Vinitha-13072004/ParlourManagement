<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nearby Parlors</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1>Nearby Parlors</h1>
        <div class="parlor-list">
            <?php
            // Database connection parameters
            $servername = "localhost";
            $username = "your_username"; // Replace with your DB username
            $password = "your_password"; // Replace with your DB password
            $dbname = "bpms"; // Replace with your DB name

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get city from query string (e.g., ?city=NewYork)
            $city = isset($_GET['city']) ? $_GET['city'] : '';

            // SQL query to fetch parlors based on the selected city
            $sql = "SELECT * FROM parlors WHERE city='$city'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data for each parlor
                while($row = $result->fetch_assoc()) {
                    echo "<div class='parlor'>";
                    echo "<img src='" . $row['picture'] . "' alt='Parlor Image'>";
                    echo "<h2>" . $row['name'] . "</h2>";
                    echo "<p>Main Service: " . $row['main_service'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No parlors found in this city.</p>";
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: auto;
    overflow: hidden;
}

h1 {
    text-align: center;
    margin: 20px 0;
}

.parlor-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.parlor {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 15px;
    width: 300px;
    text-align: center;
}

.parlor img {
    max-width: 100%;
    border-radius: 8px;
    height: 200px;
    object-fit: cover;
}

.parlor h2 {
    font-size: 1.5em;
    margin: 10px 0;
}

.parlor p {
    font-size: 1em;
    color: #555;
}
