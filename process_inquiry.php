<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inquiry Form</title>
  <link rel="stylesheet" href="./css/inquiry.css">
</head>
<body>
  <!--PHP-->
  <div id="message">
      <?php
        session_start();

        /*
        $servername = "sql301.infinityfree.com";
        $username = "if0_35599178";
        $password = "10CBmwQfMTE27y";
        $dbname = "if0_35599178_petra_ville";
        */

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "petra_ville";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // need to debug (issue mag double entry sa database)
            $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
            $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $province = isset($_POST['province']) ? $_POST['province'] : '';
            $propertyName = isset($_POST['propertyName']) ? $_POST['propertyName'] : '';
            $inquiryType = isset($_POST['inquiryType']) ? $_POST['inquiryType'] : '';
            $unitType = isset($_POST['unitType']) ? $_POST['unitType'] : '';
            $tcpRange = isset($_POST['tcpRange']) ? $_POST['tcpRange'] : '';
            $productInterest = isset($_POST['productInterest']) ? $_POST['productInterest'] : '';
            $message = isset($_POST['message']) ? $_POST['message'] : '';

            // Insert data into the table
            $sql = "INSERT INTO inquiries (first_name, last_name, email, phone, province, property_name, inquiry_type, unit_type, tcp_range, product_interest, message)
                    VALUES ('$firstName', '$lastName', '$email', '$phone', '$province', '$propertyName', '$inquiryType', '$unitType', '$tcpRange', '$productInterest', '$message')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";

                // Validate if the email is not already registered
                $emailExistsQuery = "SELECT * FROM inquiries WHERE email = '$email'";
                $result = $conn->query($emailExistsQuery);

                // Proceed with the insertion regardless of whether the email is existing or not
                $sql = "INSERT INTO inquiries (first_name, last_name, email, phone, province, property_name, inquiry_type, unit_type, tcp_range, product_interest, message)
                        VALUES ('$firstName', '$lastName', '$email', '$phone', '$province', '$propertyName', '$inquiryType', '$unitType', '$tcpRange', '$productInterest', '$message')";

                if ($conn->query($sql) === TRUE) {
                    if ($result->num_rows > 0) {
                        echo "Your inquiry is recorded. Thank you <3";
                    } else {
                        echo "The email is not exist.";
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Close the connection
        $conn->close();
      ?>

  </div>

  <div class="inquiry-container">
    <form action="process_inquiry.php" method="post">
      <label for="firstName">First Name:</label>
      <input type="text" name="firstName" id="firstName" required>

      <label for="lastName">Last Name:</label>
      <input type="text" name="lastName" id="lastName" required>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" readonly required value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>">

      <label for="phone">Phone:</label>
      <input type="tel" name="phone" id="phone" required>

      <label for="province">Province:</label>
      <select name="province" id="province" required>
        <option value="none">None</option>
        <option value="province1">Metro Manila</option>
        <option value="province2">Cavite</option>
        <option value="province3">Laguna</option>
        <option value="province4">Cebu</option>
        <option value="province5">Batangas</option>
        <option value="province6">Iloilo</option>
        <option value="province7">Davao del Sur</option>
        <option value="province8">Negros Occidental</option>
        <option value="province9">Rizal</option>
        <option value="province10">Pampanga</option>
      </select>

      <label for="propertyName">Property Name:</label>
      <select name="propertyName" id="propertyName" required>
        <option value="none">None</option>
        <option value="harmonyHaven">Harmony Haven Residences</option>
        <option value="serenitySprings">Serenity Springs Estates</option>
        <option value="crestviewMeadows">Crestview Meadows</option>
        <option value="radiantRidge">Radiant Ridge Villas</option>
        <option value="tranquilTerrace">Tranquil Terrace Homes</option>
        <option value="majesticPines">Majestic Pines Estates</option>
        <option value="azureSkies">Azure Skies Residences</option>
        <option value="goldenHorizon">Golden Horizon Heights</option>
        <option value="emeraldOasis">Emerald Oasis Gardens</option>
        <option value="summitView">Summit View Residences</option>
        <option value="enchantedGrove">Enchanted Grove Estates</option>
        <option value="lushHaven">Lush Haven Apartments</option>
        <option value="solsticeSunsets">Solstice Sunsets Condos</option>
        <option value="whisperingOaks">Whispering Oaks Residences</option>
        <option value="horizonHaven">Horizon Haven Homes</option>
        <option value="sapphireShores">Sapphire Shores Villas</option>
        <option value="edenSprings">Eden Springs Residences</option>
        <option value="radiantReflections">Radiant Reflections Condos</option>
        <option value="mysticMeadows">Mystic Meadows Estates</option>
        <option value="blissfulBreeze">Blissful Breeze Apartments</option>
      </select>

      <label for="inquiryType">Inquiry Type:</label>
      <select name="inquiryType" id="inquiryType" required>
        <option value="none">None</option>  
        <option value="propertyPurchase">Property Purchase Inquiries</option>
        <option value="rentalInquiries">Rental Inquiries</option>
      </select>

      <label for="unitType">Unit Type:</label>
      <select name="unitType" id="unitType" required>
        <option value="none">None</option>
        <option value="bungalow">Bungalow</option>
        <option value="condominium">Condominium</option>
        <option value="tomeHomes">Tome Homes</option>
      </select>

      <label for="tcpRange">TCP Range:</label>
      <select name="tcpRange" id="tcpRange" required>
        <option value="none">None</option>
        <option value="range1">Below Php 100,000</option>
        <option value="range2">Php 100,000 - Php 200,000</option>
        <option value="range3">Php 200,000 - Php 300,000</option>
      </select>

      <label for="productInterest">Product Interest:</label>
      <select name="productInterest" id="productInterest" required>
        <option value="none">None</option>  
        <option value="lotOnly">Lot Only</option>
        <option value="studioUnit">Studio Unit</option>
        <option value="bedroom1">1 Bedroom</option>
        <option value="bedroom2">2 Bedrooms</option>
        <option value="bedroom3">3 Bedrooms</option>
        <option value="bedroom4">4 Bedrooms</option>
        <option value="bedroom5">5 Bedrooms</option>
      </select>


      <label for="message">Message:</label>
      <textarea name="message" id="message" rows="4" required></textarea>

      <button type="submit">Submit</button>
      
    </form>
  </div>

  


</body>
</html>
