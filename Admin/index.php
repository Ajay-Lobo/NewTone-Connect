<?php
// Start session
session_start();

// Include the database configuration file
include('../Admin/model/config.php');
//Check if the user is already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../Admin/Home/index.php");
    exit;
}

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
            header("Location: ../Admin/Home/index.php");
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
  <link rel="shortcut icon" href="https://res.cloudinary.com/dhkh3kguy/image/upload/v1716719838/favicon_mcxew6.ico" />
  <style>
    
    @import "https://unpkg.com/open-props";

/* Colors */
:root {
  --color-white: white;
  --color-text: #130401;
  --color-bg-overlay: rgba(255, 255, 255, 0.3);
  --color-btn-bg: #271f1d;
  --color-btn-bg-hover: #100401;
  --color-error-msg:#f40b0b;
}

/* Global Styles */
*,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

*:focus {
  outline-offset: 4px;
}

button,
input {
  font: inherit;
}

/* Page Styles */
body {
  color: var(--color-white);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  background-image: url("../assets/loginbg.jpeg");
  display: grid;
  grid-template-areas: "main";
  padding: var(--size-4);
  min-height: 100vh;
  font-family: var(--font-sans);
}
.page__main {
  grid-area: main;
}
.error-message {
    color: var(--color-error-msg);
    text-align: center;
}

/* Main Styles */
.main {
  display: grid;
  align-items: center;
}
.main__login-form {
  margin-inline: auto;
  max-width: 25em;
}

/* Login Form Styles */
.login-form {
  color: var(--color-text);
  display: grid;
  position: relative;
  width: 100%;
  padding: var(--size-8);
  border: 1px solid rgba(255, 255, 255, 0.4);
  border-radius: 1em;
}
.login-form::before {
  background: var(--color-bg-overlay);
  position: absolute;
  inset: 0;
  border-radius: inherit;
  content: "";
  z-index: -4000;
  box-shadow: 0 0 2em rgba(0, 0, 0, 0.2);
  backdrop-filter: blur(5px);
}
.login-form__title {
  margin-bottom: var(--size-6);
  font-weight: var(--font-weight-6);
  font-size: var(--font-size-5);
  text-align: center;
}
.login-form__label {
  margin-bottom: var(--size-4);
  display: grid;
}
.login-form__input {
  color: inherit;
  width: 100%;
  padding: 0.8em;
  border: 0;
  border-radius: var(--radius-2);
}

/* Button Styles */
.primary-btn {
  color: var(--color-white);
  background-color: var(--color-btn-bg);
  padding: 0.9em 1.4em;
  border: 0;
  border-radius: var(--radius-2);
  cursor: pointer;
}
.primary-btn:hover {
  background-color: var(--color-btn-bg-hover);
}

/* Accessibility Styles */
.sr-only {
  position: absolute;
  margin: -1px;
  width: 1px;
  height: 1px;
  padding: 0;
  border-width: 0;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
}

  </style>
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
