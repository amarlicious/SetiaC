<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "setia";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$message = $_POST['message'] ?? '';
$imagePath = '';

if (!empty($_FILES['image']['name'])) {
  $targetDir = "uploads/";
  if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
  }
  $imagePath = $targetDir . basename($_FILES["image"]["name"]);
  move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
}

$sql = "INSERT INTO chats (user_name, message, image_path) VALUES ('Issac', ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $message, $imagePath);
$stmt->execute();

$conn->close();
header("Location: announcement.php");
exit();
?>
