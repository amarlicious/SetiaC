<?php
require('connection.php');

$nm = $_POST['name'] ?? '';
$eml = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$gdr = $_POST['gender'] ?? '';
$username = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';
$uploadPath = '';

// Hash password
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

// Urus fail gambar
if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    $uploadPath = $uploadDir . uniqid('img_') . '_' . basename($_FILES['picture']['name']);
    move_uploaded_file($_FILES['picture']['tmp_name'], $uploadPath);
}

// Simpan dalam database
$sql = "INSERT INTO member (name, email, phone, gender, username, password, picture)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $nm, $eml, $phone, $gdr, $username, $hashedPassword, $uploadPath);

if ($stmt->execute()) {
    echo "New user registered successfully!";
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
