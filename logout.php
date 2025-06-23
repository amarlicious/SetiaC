<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="refresh" content="3;URL=homebaru.php">
  <title>Logout</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .box {
      background: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      text-align: center;
      color: #333;
    }
    .box h2 {
      margin: 0 0 10px;
      color: #7B61FF;
    }
    .box p {
      font-size: 14px;
    }
  </style>
</head>
<body>

<div class="box">
  <h2>Logged Out</h2>
  <p>Redirecting to homepage...</p>
</div>

</body>
</html>
