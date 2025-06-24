<?php
session_start();
require_once('connect.php');

// Redirect non-admin users
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: nonAdmin.php");
    exit();
}

$report_list = [];
$total_reports = 0;

// Get reports
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Page </title>
    <link rel="stylesheet" href="css/admin.css" type="text/css" />
</head>
<body>

<?php include("burger.php"); ?>

<div class="head"">
    <h1>Admin</h1>
    
</div>

<div class="main-content-wrapper">
    <!-- Sidebar for Admin -->
    <div class="admin-sidebar">
        <ul>
            <li id="Home"><a href="main.php">Home</a></li>
            <li id="approve"><a href="adminApprove.php">Admin Approval</a></li>
            <li id="residence"><a href="residenceinfo.php">Residence's Information</a></li>
            <li id="feedback"><a href="feedbackadmin.php">Feedback</a></li>
            <li id="setting"><a href="statusUpdate.php">Status Update</a></li>
            <li id="setting"><a href="chart.php">Graph Category's Report</a></li>

        </ul>
    </div>  

    <!-- Main Container -->
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
