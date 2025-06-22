<?php
require('connect.php'); // pastikan $conn wujud

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

$pending_sql = "SELECT COUNT(*) AS pending_count FROM reports WHERE status = 'pending'";
if ($pending_stmt = $conn->prepare($pending_sql)) {
    $pending_stmt->execute();
    $pending_stmt->bind_result($pending_reports);
    $pending_stmt->fetch();
    $pending_stmt->close();
} else {
    echo "Error preparing pending count: " . $conn->error;
}

?>

<?php $residence_list = [];
$total_residence = 0;

$sql = "SELECT * FROM residence ORDER BY id ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $residence_list[] = $row;
    }
    $total_residence = count($residence_list); 
   } ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page - All Reports</title>
  <link rel="stylesheet" href="css/admin.css" type="text/css">
  <link rel="stylesheet" href="css/main.css">
</head>
<body>

<?php include("header.php"); ?>

<div>
  <img src="image/landscape.png" id="picture">
</div>

<main>
  <nav class="bawah">
    <h2>General</h2>
    <div class="button-group">
      <a class="select" href="report.php">Report</a>
      <a class="select" href="community.php">Community</a>
      <a class="select" href="admin.php">Admin</a>
    </div>
    <div>
      <p class="center-text">Total Registered Residence: <?= $total_residence ?></p>
      <p class="center-text">Total Reports Submitted (All Users): <?= $total_reports ?></p>
      <p class="center-text">Pending reports: <?= $pending_reports ?></p>
    </div>
  </nav>
</main>

<?php include("footer.php"); ?>

</body>
</html>