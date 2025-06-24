<?php

include("connect.php");

if (isset($_POST['submit'])) {
    $name            = htmlspecialchars($_POST['name']);
    $email           = htmlspecialchars($_POST['email']);
    $phone           = htmlspecialchars($_POST['phone']);
    $unit            = htmlspecialchars($_POST['unit']);
    $username        = htmlspecialchars($_POST['username']);
    $raw_password    = $_POST['password'];
    $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);
    
    $status = 'pending'; 

    $checkUsernameSql = "SELECT * FROM residence WHERE username = ?";
    
    if ($stmt = mysqli_prepare($conn, $checkUsernameSql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username already exists. Please choose another one.'); window.history.back();</script>";
            mysqli_stmt_close($stmt);
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error preparing username check: " . mysqli_error($conn) . "');</script>";
        exit();
    }

    $insertSql = "INSERT INTO residence (name, email, phone, unit, username, password, status) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $insertSql)) {
        mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $phone, $unit, $username, $hashed_password, $status);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Your account has been successfully registered! Please wait for an admin to approve your account before you can log in.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error creating account: " . mysqli_stmt_error($stmt) . "');</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error preparing account creation: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);

} else {
    echo "<script>alert('Invalid access.'); window.location.href='index.php';</script>";
}
?>