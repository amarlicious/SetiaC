<?php
session_start();
require_once('../dakzulLatest/connect.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: nonAdmin.php");
    exit();
}

$report_list = [];
$total_reports = 0;

$sql = "SELECT r.*, res.username AS reporter_username 
        FROM reports r 
        JOIN residence res ON r.user_id = res.id 
        ORDER BY r.report_date DESC";

if ($stmt = $conn->prepare($sql)) {
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $report_list[] = $row;
    }

    $total_reports = count($report_list);
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - All Reports</title>
    <link rel="stylesheet" href="../css/admin.css" type="text/css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .main-content-wrapper {
            display: flex;
            flex-grow: 1;
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .admin-sidebar {
            flex: 0 0 200px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-right: 20px;
            height: fit-content;
        }

        .admin-sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .admin-sidebar li {
            margin-bottom: 10px;
        }

        .admin-sidebar a {
            text-decoration: none;
            color: #333;
            padding: 8px 10px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .admin-sidebar a:hover {
            background-color: #e0e0e0;
        }

        .admin {
            font-size: 24px;
            font-weight: bold;
            color: black;
            margin-bottom: 20px;
            text-align: center;
        }

        .container2 {
            flex-grow: 1;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            line-height: 1.6; 
        }

        .report-table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 90%;
        }

        .report-table th, .report-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .report-table th {
            background-color: #f0f0f0;
        }

        .center-text {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php include("../header.php"); ?>
<?php include("burger.php"); ?>

<div class="main-content-wrapper">
    <div class="admin-sidebar">
        <p class="admin">Admin</p>
        <ul>
            <li id="Home"><a href="../dakzulLatest/main.php">Home</a></li>
            <li id="Report"><a href="report.php">Report</a></li>
            <li id="feedback"><a href="../dakzulLatest/feedback.php">Feedback</a></li>
            <li id="setting"><a href="../homepage/statusUpdate.php">Status Update</a></li>
        </ul>
    </div>     

    <div class="container2">
        <p class="center-text">Total Reports Submitted (All Users): <?= $total_reports ?></p>

        <?php if (!empty($report_list)): ?>
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Report ID</th>
                        <th>Reporter</th>
                        <th>Report Text</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($report_list as $report): ?>
                        <tr>
                            <td><?= htmlspecialchars($report['report_id']) ?></td>
                            <td><?= htmlspecialchars($report['reporter_username']) ?></td>
                            <td><?= htmlspecialchars($report['report_text']) ?></td>
                            <td><?= htmlspecialchars($report['category']) ?></td>
                            <td><?= htmlspecialchars($report['report_date']) ?></td>
                            <td><?= htmlspecialchars($report['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="center-text" style="font-size:16px;">No report defined.</p>
        <?php endif; ?>
    </div>
</div>

<?php
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}
?>

</body>
</html>