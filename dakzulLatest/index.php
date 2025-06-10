<?php
session_start();
if (isset($_SESSION['username']))
{
    $_SESSION = array();
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="styleLogReg.css" type="text/css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <section>
  <div class="container">
    <div class="kiri"> <img src = "homepage.jpg" width="100%"></div>
    <div class="kanan">
    <div class="login-container">
      <h2>Sign In</h2>
      <form action="login.php" method="POST">
        <table>
          <tr>
            <th>Username:</th>
            <td><input type="text" name="username"></td>
          </tr>
          <tr>
            <th>Password:</th>          
            <td><input type="password" name="password"></td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="submit" value="login" name="login">
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