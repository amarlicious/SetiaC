<?php
require('connect.php');

$uploadPath = '';
$report = $_POST['report'];
$eml = $_POST['email'];
$phone = $_POST['gender'];
$username = $_POST['username'];
$password = $_POST['password'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

if(isset($_FILES['picture'])&& $_FILES['picture']['error'] == 0){
    $uploadDir ='uploads/';
    if(!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $uploadPath = $uploadDir . uniqid('img_') . '_' . basename($_FILES['picture']['name']);
    move_uploaded_file($_FILES['picture']['tmp_name'], $uploadPath);
}

$sql = "INSERT INTO member (name, email, phone, gender, username, password, picture)
        VALUES('$nm', '$eml', '$phone', '$gdr', '$username', '$hashedPassword', '$uploadPath')";

if($conn->query($sql) === TRUE){
    echo "New record created succesfully";
    echo "<meta http-equiv='refresh' content='3;URL=index.php'>";
} else{
    echo "Error: " . $conn->error;
}
$conn->close();
?>