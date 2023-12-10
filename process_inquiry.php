<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inquiry Form</title>
  <link rel="stylesheet" href="inquiry.css">
</head>
<body>

  <div class="inquiry-container">
    <form action="process_inquiry.php" method="post">
      <label for="firstName">First Name:</label>
      <input type="text" name="firstName" id="firstName" required>

      <label for="lastName">Last Name:</label>
      <input type="text" name="lastName" id="lastName" required>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>

      <label for="phone">Phone:</label>
      <input type="tel" name="phone" id="phone" required>

      <label for="province">Province:</label>
      <select name="province" id="province" required>
        <option value="province1">Province 1</option>
        <option value="province2">Province 2</option>
      </select>

      <label for="propertyName">Property Name:</label>
      <select name="propertyName" id="propertyName" required>
        <option value="property1">Property 1</option>
        <option value="property2">Property 2</option>
      </select>

      <label for="inquiryType">Inquiry Type:</label>
      <select name="inquiryType" id="inquiryType" required>
        <option value="general">General Inquiry</option>
        <option value="booking">Booking Inquiry</option>
      </select>

      <label for="unitType">Unit Type:</label>
      <select name="unitType" id="unitType" required>
        <option value="type1">Type 1</option>
        <option value="type2">Type 2</option>
      </select>

      <label for="tcpRange">TCP Range:</label>
      <select name="tcpRange" id="tcpRange" required>
        <option value="range1">Php 100,000 - Php 200,000</option>
        <option value="range2">Php 200,000 - Php 300,000</option>
      </select>

      <label for="productInterest">Product Interest:</label>
      <select name="productInterest" id="productInterest" required>
        <option value="interest1">Interest 1</option>
        <option value="interest2">Interest 2</option>
      </select>

      <label for="message">Message:</label>
      <textarea name="message" id="message" rows="4" required></textarea>

      <button type="submit">Submit</button>
      <!--PHP-->
      <div id="message">
        <?php
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

          // Sample data (replace with your form data)
          $firstName = $_POST['firstName'];
          $lastName = $_POST['lastName'];
          $email = $_POST['email'];
          $phone = $_POST['phone'];
          $province = $_POST['province'];
          $propertyName = $_POST['propertyName'];
          $inquiryType = $_POST['inquiryType'];
          $unitType = $_POST['unitType'];
          $tcpRange = $_POST['tcpRange'];
          $productInterest = $_POST['productInterest'];
          $message = $_POST['message'];

          // Insert data into the table
          $sql = "INSERT INTO inquiries (first_name, last_name, email, phone, province, property_name, inquiry_type, unit_type, tcp_range, product_interest, message)
                  VALUES ('$firstName', '$lastName', '$email', '$phone', '$province', '$propertyName', '$inquiryType', '$unitType', '$tcpRange', '$productInterest', '$message')";

          if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }

          // Close the connection
          $conn->close();
        ?>
      </div>


    </form>
  </div>

  


</body>
</html>
