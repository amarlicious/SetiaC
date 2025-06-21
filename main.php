<?php
session_start();
require_once('connect.php');

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
    <link rel="stylesheet" href="css/admin.css" type="text/css">

</head>
<body>


<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Page General</title>
  <link rel="stylesheet" href="css/main.css">


</head>
<?php include("header.php");  ?>
<body>
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
      
    <p class="center-text">Total Reports Submitted (All Users): <?= $total_reports ?></p>

      </div>
    </nav>
  </main>
<?php include("footer.php");  ?>
</body>
</html>
