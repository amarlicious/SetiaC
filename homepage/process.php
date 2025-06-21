<?php
session_start();
require_once '../dakzulLatest/connect.php';

// Sekat akses jika bukan admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    echo "<meta http-equiv='refresh' content='3;URL=../login.php'>";
    exit();
}

// Proses POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // KEMASKINI STATUS
    if ($action === 'update' && isset($_POST['report_id'], $_POST['new_status'])) {
        $report_id = $_POST['report_id'];
        $new_status = $_POST['new_status'];

        $stmt = $conn->prepare("UPDATE reports SET status = ? WHERE report_id = ?");
        $stmt->bind_param("si", $new_status, $report_id);
        $stmt->execute();
        $stmt->close();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // PADAM LAPORAN
    if ($action === 'delete' && isset($_POST['report_id'])) {
        $report_id = $_POST['report_id'];
        $del = $conn->prepare("DELETE FROM reports WHERE report_id = ?");
        $del->bind_param("i", $report_id);
        $del->execute();
        $del->close();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // SIMPAN CATATAN ADMIN UNTUK LAPORAN
    if ($action === 'note' && isset($_POST['report_id'], $_POST['admin_note'])) {
        $report_id = $_POST['report_id'];
        $admin_note = $_POST['admin_note'];

        $stmt = $conn->prepare("UPDATE reports SET adminDesc = ? WHERE report_id = ?");
        $stmt->bind_param("si", $admin_note, $report_id);
        $stmt->execute();
        $stmt->close();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Cari berdasarkan nama pengguna jika ada carian
$searchTerm = $_GET['search'] ?? '';
$param = "%{$searchTerm}%";
$stmt = $conn->prepare("SELECT r.report_id, r.report_text, r.status, r.adminDesc, res.username, res.id AS residence_id
                        FROM reports r
                        JOIN residence res ON r.user_id = res.id
                        WHERE res.username LIKE ?
                        ORDER BY r.report_date DESC");
$stmt->bind_param("s", $param);
$stmt->execute();
$result = $stmt->get_result();
?>