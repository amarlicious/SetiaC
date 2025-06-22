<?php
session_start();
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $input_password = $_POST['password'];

    // 1. Semak dalam table admin
    $sqlAdmin = "SELECT * FROM admin WHERE username = '$username'";
    $resultAdmin = $conn->query($sqlAdmin);

    if ($resultAdmin && $resultAdmin->num_rows === 1) {
        $admin = $resultAdmin->fetch_assoc();

        if (password_verify($input_password, $admin['password'])) {
            $_SESSION['username'] = $admin['username'];
            $_SESSION['role'] = 'admin';

            header("Location: main.php"); 
            exit();
        } else {
            $error = "Login Fail: Wrong password (admin)";
        }
    } else {
        // 2. Semak dalam table residence
        $sqlUser = "SELECT * FROM residence WHERE username = '$username'";
        $resultUser = $conn->query($sqlUser);

        if ($resultUser && $resultUser->num_rows === 1) {
            $user = $resultUser->fetch_assoc();

            if (password_verify($input_password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = 'user';

                header("Location: main.php"); // user dashboard
                exit();
            } else {
                $error = "Login Fail: Wrong password (user)";
            }
        } else {
            $error = "Login Fail: Username doesn't exist";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Response</title>
  <style>
    .message {
      color: red;
      background-color: #f9d6d5;
      padding: 12px 20px;
      margin: 20px auto;
      width: fit-content;
      border: 1px solid #d9534f;
      border-radius: 6px;
      font-weight: bold;
      font-family: 'Segoe UI', sans-serif;
    }
  </style>
</head>
<body>
  <?php if (!empty($error)): ?>
    <div class="message"><?= htmlspecialchars($error) ?></div>
    <meta http-equiv="refresh" content="3;URL=index.php">
  <?php endif; ?>
</body>
</html>
