<?php
// Start session
//session_start();

// Include the database configuration file
include('../model/config.php');

// Check if the user is already logged in
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: dashboard.php");
//     exit;
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['uname'];
    $password = $_POST['psw'];

    // Hash the provided password using MD5 to match the stored format
    $hashed_password_input = md5($password);

    // Prepare a statement to select user data from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if ($hashed_password_input === $user['password']) {
            // Password is correct, set session variables and redirect to dashboard
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("Location: ../Admin/index.php");
            exit();
        } else {
            // Password is incorrect
            $error_message = "Incorrect Password";
        }
    } else {
        // User not found
        $error_message = "Invalid Username";
    }

    // Close the prepared statement
    $stmt->close();
    // Close the database connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="page">
  <main class="main page__main">
    <form class="login-form main__login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <h3 class="login-form__title">Login</h3>
      <?php
      // Display error message if set
      if (isset($error_message)) {
          echo '<div class="error-message">' . $error_message . '</div><br>';
      }
      ?>
      <label class="login-form__label" for="uname"><span class="sr-only">Username</span>
        <input class="login-form__input" type="text" id="uname" name="uname" value="" placeholder="Username" required="required"/>
      </label>
      <label class="login-form__label" for="psw"><span class="sr-only">Password</span>
        <input class="login-form__input" type="password" id="psw" name="psw" value="" placeholder="Password" required="required"/>
      </label>
      <button class="primary-btn" type="submit">Login</button>
    </form>
  </main>
</body>
</html>
