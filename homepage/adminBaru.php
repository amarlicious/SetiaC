<?php
require_once '../dakzulLatest/connect.php';


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
        select, input[type=text], button, textarea {
            padding: 5px;
        }
        textarea {
            width: 100%;
            resize: vertical;
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
        .form-container, .search-container {
            width: 90%;
            margin: 20px auto;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<?php include("../adminfile/burger.php"); ?>

<div class="header">
    <h1 id="text">Admin</h1>
</div>

<div class="search-container">
    <form method="GET">
        <label for="search">Cari Username: </label>
        <input type="text" name="search" value="<?= htmlspecialchars($searchTerm) ?>" placeholder="Contoh: ali123">
        <button type="submit">Cari</button>
        <a href="<?= $_SERVER['PHP_SELF'] ?>">Reset</a>
    </form>
</div>

<div class="container">
    <div class="main-content">
        <table>
            <tr>
                <th>Name</th>
                <th>Residence ID</th>
                <th>Description</th>
                <th>Status</th>
                <th>Admin Note</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['residence_id']) ?></td>
                    <td><?= htmlspecialchars($row['report_text']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td><?= htmlspecialchars($row['adminDesc']) ?></td>
                    <td>
                        <form method="POST" action="process.php" style="margin-bottom:5px;">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="report_id" value="<?= $row['report_id'] ?>">
                            <select name="new_status" onchange="this.form.submit()">
                                <option value="Pending" <?= $row['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Solved" <?= $row['status'] === 'Solved' ? 'selected' : '' ?>>Solved</option>
                            </select>
                        </form>

                        <form method="POST" action="process.php"style="margin-bottom:5px;">
                            <input type="hidden" name="action" value="note">
                            <input type="hidden" name="report_id" value="<?= $row['report_id'] ?>">
                            <textarea name="admin_note" rows="2" placeholder="Catatan admin..."><?= htmlspecialchars($row['adminDesc']) ?></textarea>
                            <button type="submit">Simpan Nota</button>
                        </form>

                        <form method="POST" action="process.php" onsubmit="return confirm('Padam laporan ini?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="report_id" value="<?= $row['report_id'] ?>">
                            <button type="submit" style="background-color:red;color:white;">Padam</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
