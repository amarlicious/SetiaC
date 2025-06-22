<?php
session_start();
include('connect.php');

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    echo "Admins are not allowed to submit feedback.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
    $text = isset($_POST['feedback_text']) ? trim($_POST['feedback_text']) : '';
    $date = date("Y-m-d H:i:s");

    if (!empty($text)) {
        $stmt = $conn->prepare("INSERT INTO feedback (Username, text, date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $text, $date);
        if ($stmt->execute()) {
            header("Location: feedbacksubmit.php?feedback_id=" . $stmt->insert_id);
            exit();
        } else {
            echo "Error saving feedback.";
        }
    } else {
        echo "Feedback cannot be empty.";
    }
}
?>
