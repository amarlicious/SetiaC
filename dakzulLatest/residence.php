<?php
require('connect.php');

$nm = $_POST['name'];
$eml = $_POST['email'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];
$uploadPath = '';

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

if(isset($_FILES['picture'])&& $_FILES['picture']['error'] == 0){
    $uploadDir ='uploads/';
    if(!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $uploadPath = $uploadDir . uniqid('img_') . '_' . basename($_FILES['picture']['name']);
    move_uploaded_file($_FILES['picture']['tmp_name'], $uploadPath);
}

$sql = "INSERT INTO residence (name, email, phone, username, password, picture)
        VALUES('$nm', '$eml', '$phone', '$username', '$hashedPassword', '$uploadPath')";

if($conn->query($sql) === TRUE){
    echo "New record created succesfully";
    echo "<meta http-equiv='refresh' content='3;URL=index.php'>";
} else{
    echo "Error: " . $conn->error;
}
$conn->close();
?>