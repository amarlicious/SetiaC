<?php
session_start();

// Redirect user if already logged in
// This prevents logged-in users from seeing the login form and being logged out automatically.
if (isset($_SESSION['username'])) {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'admin') {
            header("Location: mainAdmin.php");
            exit();
        } elseif ($_SESSION['role'] === 'user') {
            header("Location: main.php");
            exit();
        }
    }
    // Fallback if role is not set but username is (shouldn't happen with proper login script)
    header("Location: main.php");
    exit();
}

// If the user is NOT logged in, then display the login form below.
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/index.css" type="text/css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
</head>
<body>
  <section>
    <div class="container">
      <div class="kiri"> <img src = "image/homepage.jpg" width="100%"></div>
      <div class="kanan">
        <div class="login-container">
          <h2>Sign In</h2>

          <form action="login.php" method="POST">
            <table>
              <tr>
                <th>Username:</th>
                <td><input type="text" name="username" required></td>
              </tr>
              <tr>
                <th>Password:</th>         
                <td><input type="password" name="password" required></td>
              </tr>
              <tr>
                <td colspan="2">
                  <input type="submit" value="Login" name="login">
                </td>
              </tr>
            </table>
          </form>

          <p class="center"><b>New user? <a href="register.html">Sign-up now..</a></b></p>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
