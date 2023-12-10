<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>

<!--PHP registratioN-->
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

// Initialize error variable
$error = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve registration data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert data into the table
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            header("Location: registered.html");//to be add another html soon
        } else {
            if ($conn->errno == 1062) { // 1062 is the MySQL error code for duplicate entry
                $error = 'Email address already exists.';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

// Close the connection
$conn->close();
?>

<!--REGISTRATION FORM-->
  <div class="register-container">
    <form action="register.php" method="post">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>

      <label for="confirmPassword">Confirm Password:</label>
      <input type="password" name="confirmPassword" id="confirmPassword" required>

      <?php
      // Display error message if present
      if ($error) {
          echo '<p class="error-message">Error: ' . $error . '</p>';
      }
      ?>

      <button type="submit">Register</button>
    </form>
  </div>

</body>
</html>
