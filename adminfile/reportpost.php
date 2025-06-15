<?php
include('connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    echo "Access denied. Please log in.";
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
    exit();
}

$report_text = $_POST['report_text'] ?? '';
$categories = $_POST['site'] ?? [];
$picturePath = '';

$category_string = implode(', ', $categories);

if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
    $uploadDir = 'report_uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    $picturePath = $uploadDir . uniqid('rpt_') . '_' . basename($_FILES['picture']['name']);
    move_uploaded_file($_FILES['picture']['tmp_name'], $picturePath);
}

$username = $_SESSION['username'];
$get_user_sql = "SELECT id FROM member WHERE username = '$username'";
$user_result = $conn->query($get_user_sql);

if ($user_result && $user_result->num_rows === 1) {
    $user = $user_result->fetch_assoc();
    $user_id = $user['id'];

    $sql = "INSERT INTO report (user_id, picture, report_text, category)
            VALUES ('$user_id', '$picturePath', '$report_text', '$category_string')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['last_report_id'] = $conn->insert_id;
        echo "<meta http-equiv='refresh' content='0; URL=reportsubmit.php'>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "User not found.";
}

$conn->close();
?>
