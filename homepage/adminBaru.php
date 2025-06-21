<?php
session_start();
require_once '../dakzulLatest/connect.php';

// Sekat akses jika bukan admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    echo "<meta http-equiv='refresh' content='3;URL=../login.php'>";
    exit();
}

// Kemaskini status laporan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_id'], $_POST['new_status'])) {
    $report_id = $_POST['report_id'];
    $new_status = $_POST['new_status'];
    
    $stmt = $conn->prepare("UPDATE reports SET status = ? WHERE report_id = ?");
    $stmt->bind_param("si", $new_status, $report_id);
    $stmt->execute();
    $stmt->close();
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Ambil semua laporan
$sql = "SELECT r.report_id, r.report_text, r.status, res.username, res.id AS residence_id
        FROM reports r
        JOIN residence res ON r.user_id = res.id
        ORDER BY r.report_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../css/admin.css" type="text/css">
    <style>
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
        select {
            padding: 5px;
        }
        .header {
    background-color: #7B61FF;
    color: white;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: flex-start; 
    gap: 20px; 
    font-family: Arial, sans-serif;
}
#text {
    font-size: 40px;
    font-weight: bold;
    text-align: center;
    display: block;
    width: 100%;
}
    </style>
</head>
<body>

<?php include("../adminfile/burger.php"); ?>

 <div class="header">
        <h1 id="text">Admin</h1>
    </div>
<div class="container">
   

    <div class="main-content">
       

        <table>
            <tr>
                <th>Name</th>
                <th>Residence ID</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['residence_id']) ?></td>
                    <td><?= htmlspecialchars($row['report_text']) ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="report_id" value="<?= $row['report_id'] ?>">
                            <select name="new_status" onchange="this.form.submit()">
                                <option value="Pending" <?= $row['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Solved" <?= $row['status'] === 'Solved' ? 'selected' : '' ?>>Solved</option>
                            </select>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>

