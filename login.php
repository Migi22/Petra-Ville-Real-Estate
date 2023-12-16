<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="./css/login.css" />
  </head>
  <body>
    <div class="log-in-page">
      <div class="overlap-wrapper">
        <div class="overlap">
          <header class="header">
            
              <a id="logo" href="index.php">Petra Ville Real Estate</a>
          
            <div class="navbar">
              <div class="text-wrapper">Home</div>
              <div class="div">Properties</div>
              <div class="text-wrapper-2">About</div>
              <div class="text-wrapper-3">Contact</div>
              <div class="text-wrapper-4">Log In</div>
            </div>
          </header>
          <div class="body">
            <div class="overlap-group">
              <div class="text-wrapper-5">Sign In</div>
              <div class="text-wrapper-6">
                <a href="register.php" id="signUp">Sign Up</a>
              </div>
              <div class="text-wrapper-7">or</div>
              <p class="slogan">Unlock Your <br />Dream Home <br />with Us!</p>
              
              <div class="login-container">
                <form action="login.php" method="post">
                <div class="email-address">
                  <input type="email" placeholder="Email Address" name="email" id="email" required>
                </div>
                <div class="password">
                  <input type="password" placeholder="Password" name="password" id="password" required>
                </div>
                <div class="sign-in-button">
                  <button type="submit">Sign In</button>
                </div>

                <div id="error-message">
                <?php
                  session_start();
                  // Check if the user is already logged in
                  if (isset($_SESSION['user_email'])) {
                    // Redirect the user to the index page
                    header("Location: index.php");
                    exit();
                  }


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
                      // Retrieve login data
                      $email = $_POST['email'];
                      $enteredPassword = $_POST['password'];

                      // SQL query to check if the user exists
                      $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                          // User found, verify password
                          $row = $result->fetch_assoc();

                          /* debugging
                          echo "Entered Password: $enteredPassword <br>";
                          echo "Hashed Password from DB: " . $row['password'] . "<br>";*/

                          if (password_verify($enteredPassword, $row['password'])) {
                            $_SESSION['user_email'] = $email;
                            header("Location: index.php");
                          } else {
                              echo "Incorrect password.";
                              
                          }
                      } else {
                          echo "User not found.";
                          $email = "";
                      }
                    }

                  // Close the connection
                  $conn->close();
                ?>
                </div>
              
              </div>

              <div class="sign-in-google">
                <div class="overlap-3">
                  <div class="text-wrapper-11">Sign In with Google</div>
                  <div class="log-in-button"></div>
                  <img class="icon-google" src="img/icon-google.png" />
                </div>
              </div>
              <div class="sign-in-apple">
                <div class="overlap-3">
                  <div class="text-wrapper-12">Sign In with Apple</div>
                  <div class="log-in-button"></div>
                  <img class="icon-apple" src="img/icon-apple.png" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

