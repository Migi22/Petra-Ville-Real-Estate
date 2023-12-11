<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="register.css" />
  </head>
  <body>
    <div class="log-in-page">
      <div class="overlap-wrapper">
        <div class="overlap">
          <header class="header">
            
              <a id="logo" href="/">Petra Ville Real Estate</a>
          
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
              <div class="text-wrapper-5">
                <a href="login.php" id="signIn">Sign In</a>
              </div>
              <div class="text-wrapper-6">Sign Up</div>
              <div class="text-wrapper-7">or</div>
              <p class="slogan">Unlock Your <br />Dream Home <br />with Us!</p>
              
              <div class="login-container">
                <form action="test.php" method="post">
                <div class="email-address">
                  <input type="email" placeholder="Email Address" name="email" id="email" required>
                </div>
                <div class="password">
                  <input type="password" placeholder="Password" name="password" id="password" required>
                </div>
                <div class="confirmPassword">
                  <input type="password" placeholder="Password" name="confirmPassword" id="confirmPassword" required>
                </div>

                <div class="sign-up-button">
                  <button type="submit">Sign Up</button>
                </div>
                </form>
                <div id="error-message">
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
                
                        // Use prepared statement to insert data into the table
                        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
                        $stmt->bind_param("ss", $email, $hashedPassword);
                
                        if ($stmt->execute()) {
                            header("Location: registered.html"); // Redirect upon successful registration
                        } else {
                            if ($conn->errno == 1062) { // 1062 is the MySQL error code for duplicate entry
                                $error = 'Email address already exists.';
                            } else {
                                echo "Error: " . $stmt->error;
                            }
                        }
                
                        // Close the prepared statement
                        $stmt->close();
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

