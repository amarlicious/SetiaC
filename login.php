<?php
session_start();
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $input_password = $_POST['password'];

    // 1. Semak dalam table admin (username)
    $sqlAdmin = "SELECT * FROM admin WHERE username = ?";
    if ($stmtAdmin = $conn->prepare($sqlAdmin)) {
        $stmtAdmin->bind_param("s", $username);
        $stmtAdmin->execute();
        $resultAdmin = $stmtAdmin->get_result();

        if ($resultAdmin && $resultAdmin->num_rows === 1) {
            $admin = $resultAdmin->fetch_assoc();
            if (password_verify($input_password, $admin['password'])) {
                $_SESSION['username'] = $admin['username'];
                $_SESSION['role'] = 'admin';
                header("Location: mainAdmin.php"); 
                exit();
            } else {
                $error = "Login Fail: Wrong password (admin)";
            }
        }
        $stmtAdmin->close();
    } else {
        $error = "Login Fail: Database query error for admin.";
    }


    // Jika bukan admin, semak dalam table residence (hanya jika belum login sebagai admin)
    if (!isset($_SESSION['role'])) {
        $sqlUser = "SELECT * FROM residence WHERE username = ?";
        if ($stmtUser = $conn->prepare($sqlUser)) {
            $stmtUser->bind_param("s", $username);
            $stmtUser->execute();
            $resultUser = $stmtUser->get_result();

            if ($resultUser && $resultUser->num_rows === 1) {
                $user = $resultUser->fetch_assoc();

                // SEMAK STATUS PENGGUNA DI SINI
                if ($user['status'] === 'pending') {
                    $error = "Login Fail: Your account is pending approval by admin.";
                } elseif ($user['status'] === 'rejected') {
                    $error = "Login Fail: Your account has been rejected by admin. Please contact support.";
                } elseif (password_verify($input_password, $user['password'])) {
                    // Status 'approved' dan password betul
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = 'user';
                    $_SESSION['unit'] = $user['unit']; // Simpan unit dalam sesi jika diperlukan
                    header("Location: main.php");
                    exit();
                } else {
                    $error = "Login Fail: Wrong password (user)";
                }
            } else {
                $error = "Login Fail: Username doesn't exist"; 
            }
            $stmtUser->close();
        } else {
            $error = "Login Fail: Database query error for user.";
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