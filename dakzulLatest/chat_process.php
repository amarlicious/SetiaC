<?php
session_start();
include('connect.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$user = $_SESSION['username'];
$message = $conn->real_escape_string($_POST['message']);
$imagePath = "";

if (!empty($_FILES["image"]["name"])) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir);
    $fileName = basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . time() . "_" . $fileName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $imagePath = $targetFile;
    }
}

$stmt = $conn->prepare("INSERT INTO chat (user_name, message, image_path) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $user, $message, $imagePath);
$stmt->execute();
$stmt->close();

header("Location: community.php");
exit();
