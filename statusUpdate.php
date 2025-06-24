<?php
session_start();
require_once 'connect.php';

// Semak jika admin sudah log masuk
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    echo "<meta http-equiv='refresh' content='3;URL= login.php'>";
    exit();
}

// nak cari guna username
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// SQL: gabung carian + susunan
$sql = "SELECT r.report_id, r.report_text, r.status, res.username, res.id AS residence_id
        FROM reports r
        JOIN residence res ON r.user_id = res.id";

if (!empty($search)) {
    $sql .= " WHERE res.username LIKE '%$search%'";
}

$sql .= " ORDER BY r.report_date DESC";

$result = $conn->query($sql);

// ======== KEMASKINI STATUS ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_id'], $_POST['new_status'])) {
    $report_id = $_POST['report_id'];
    $new_status = $_POST['new_status'];
    
    $stmt = $conn->prepare("UPDATE reports SET status = ? WHERE report_id = ?");
    $stmt->bind_param("si", $new_status, $report_id);
    $stmt->execute();
    $stmt->close();

    // Elak refresh POST semula
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// ======== KEMASKINI ADMIN DESC ==========
if (isset($_POST['submit_desc'])) {
    $adminDesc = $_POST['admin_desc'];
    $report_id = $_POST['report_id'];

    $stmt = $conn->prepare("UPDATE reports SET adminDesc = ? WHERE report_id = ?");
    $stmt->bind_param("si", $adminDesc, $report_id);
    $stmt->execute();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Report Table</title>
    <style>
             body, html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid green;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .btn-delete:hover {
            background-color: #c0392b;
        }
        .edit-button {
            background-color: #7B61FF;
            color: white;
            padding: 6px 16px;        
            border-radius: 8px;
            cursor: pointer;
            display: inline-block;
            margin: 20px auto;
            font-size: 14px;         
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .edit-button:hover {
            background-color: purple;
        }
        #button-back {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        textarea {
            border-radius: 5px;
            padding: 5px;
            resize: vertical;
            font-family: Arial;
        }

                .head {
            background-color: #7B61FF;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            color: white;
            font-size: 24px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }
    </style>
    </style>
</head>
<body>
    <?php include("burger.php");  ?>

<div class="head"><h1>All report (Admin view)</h1></div>

<div class="container">
    <!-- Form Carian -->
<form method="GET" style="text-align:center; margin-bottom: 20px;">
    <label for="search">Search Username: </label>
    <input type="text" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <button type="submit">Search</button>
</form>

<!-- Jadual -->
<table>
    <tr>
        <th>Name</th>
        <th>Residence ID</th>
        <th>Report ID</th>
        <th>Description</th>
        <th>Status</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['residence_id']) ?></td>
        <td><?= htmlspecialchars($row['report_id']) ?></td>
        <td><?= htmlspecialchars($row['report_text']) ?></td>
        <td>
            <form method="POST">
                <input type="hidden" name="report_id" value="<?= $row['report_id'] ?>">
                <select name="new_status" onchange="this.form.submit()">
                    <option value="Pending" <?= ($row['status'] === 'Pending') ? 'selected' : '' ?>>Pending</option>
                    <option value="Solved" <?= ($row['status'] === 'Solved') ? 'selected' : '' ?>>Solved</option>
                </select>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<div id="button-back">
    <a href="admin.php" class="edit-button">Back</a>
</div>
</div>

</body>
</html>
