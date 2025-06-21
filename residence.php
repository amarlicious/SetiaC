<?php
include("connect.php");

if (isset($_POST['submit'])) {
    $name     = htmlspecialchars($_POST['name']);
    $email    = htmlspecialchars($_POST['email']);
    $phone    = htmlspecialchars($_POST['phone']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // SEMAK sama ada username sudah wujud
    $checkUsername = "SELECT * FROM residence WHERE username = '$username'";
    $result = mysqli_query($conn, $checkUsername);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username already exists. Please choose another one.'); window.history.back();</script>";
        exit();
    }

    // Jika belum wujud, insert
    $sql = "INSERT INTO residence (name, email, phone, username, password) 
            VALUES ('$name', '$email', '$phone', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Account created successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
