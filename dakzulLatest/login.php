<?php
session_start();
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dapatkan input dari form
    $username = $_POST['username'];
    $input_password = $_POST['password'];

    // Cari pengguna dalam DB
    $sql = "SELECT * FROM residence WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Semak password yang dimasukkan
        if (password_verify($input_password, $user['password'])) {
            // Simpan info user ke session
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect ikut role
            if ($user['role'] === 'admin') {
                header("Location: main.php");
                exit();
            } else if ($user['role'] === 'User') {
                header("Location: ../fileUser/mainUser.php");
                exit();
            }
        } else {
            // Password salah
            $error = "Login Fail: Wrong password";
        }
    } else {
        // Username tak wujud
        $error = "Login Fail: Username doesn't exist";
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
