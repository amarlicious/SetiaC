<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_id'])) {
    $report_id = $_POST['report_id'];
    
    // Pastikan hanya laporan milik user yang log masuk boleh dipadam
    $username = $_SESSION['username'];
    $sql = "DELETE r FROM reports r 
            JOIN residence res ON r.user_id = res.id 
            WHERE r.report_id = ? AND res.username = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("is", $report_id, $username);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
}

header("Location: history.php"); // balik ke page asal lepas delete
exit();
