<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    echo "<meta http-equiv='refresh' content='3;URL= login.php'>";
    exit();
}

// Kemaskini status jika ada POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_id'], $_POST['new_status'])) {
    $report_id = $_POST['report_id'];
    $new_status = $_POST['new_status'];
    
    $stmt = $conn->prepare("UPDATE reports SET status = ? WHERE report_id = ?");
    $stmt->bind_param("si", $new_status, $report_id);
    $stmt->execute();
    $stmt->close();
    header("Location: ".$_SERVER['PHP_SELF']);
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
<html>
<head>
    <title>Admin Report Table</title>
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


    </style>
</head>
<body>

<h2 style="text-align:center;">All Reports (Admin View)</h2>

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
 <div id="button-back"> <a href="admin.php" class="edit-button">Back</a></div>
  

</body>
</html>
