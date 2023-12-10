<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>

  <div class="login-container">
    <form action="login.php" method="post">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Login</button>

      <div class="error-message">
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

          // Check if form is submitted
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              // Retrieve login data
              $email = $_POST['email'];
              $password = $_POST['password'];

              // SQL query to check if the user exists
              $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // User found, verify password
                  $row = $result->fetch_assoc();
                  $hashedPassword = $row['password'];

                  if (password_verify($password, $hashedPassword)) {
                      echo "Login successful!";
                  } else {
                      echo "Incorrect password.";
                  }
              } else {
                  echo "User not found.";
              }
          }

          // Close the connection
          $conn->close();
        ?>
      </div>
    </form>
  </div>

</body>
</html>
