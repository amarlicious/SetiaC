<?php
session_start();
require('connect.php');


if (!isset($_SESSION['username'])) {
    echo "Access denied.";
    echo "<meta http-equiv='refresh' content='3; URL=login.php'>";
    exit();
}

// Get report list
$report_list = [];
$total_reports = 0;
$pending_reports = 0;

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

// Count pending reports
$pending_sql = "SELECT COUNT(*) AS pending_count FROM reports WHERE status = 'pending'";
if ($pending_stmt = $conn->prepare($pending_sql)) {
    $pending_stmt->execute();
    $pending_stmt->bind_result($pending_reports);
    $pending_stmt->fetch();
    $pending_stmt->close();
} else {
    echo "Error preparing pending count: " . $conn->error;
}

// Get residence count
$residence_list = [];
$total_residence = 0;

$sql = "SELECT * FROM residence ORDER BY id ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $residence_list[] = $row;
    }
    $total_residence = count($residence_list); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page - Dashboard</title>
  <link rel="stylesheet" href="css/admin.css" type="text/css">
  <link rel="stylesheet" href="css/main.css">
  <style>
    .button-group {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin: 20px 0;
    }
    .select {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
    }
    .select:hover {
      background-color: #45a049;
    }
    .center-text {
      text-align: center;
      margin: 10px 0;
      color:#7B61FF;
    }
  
  .info-box {
  display: flex;
  justify-content: space-around;
  align-items: center;
  background-color: #f7faff;
  border: 2px solid #d1d9e6;
  border-radius: 15px;
  padding: 20px;
  margin: 20px auto;
  max-width: 800px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  flex-wrap: wrap; /* Responsive */
}

.info-item {
  flex: 1 1 200px;
  text-align: center;
  margin: 10px;
  background-color: white;
  border-radius: 10px;
  padding: 15px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.info-item h3 {
  margin-bottom: 8px;
  font-size: 16px;
  color: #333;
}

.info-item p {
  font-size: 20px;
  color: #007acc;
  font-weight: bold;
}

.semuabox {
  display: flex;
  justify-content: center;
  gap: 30px; /* ruang antara item */
  background-color: #f0f4f8;
  border: 2px solid #d1d9e6;
  border-radius: 15px;
  padding: 15px 20px;
  margin: 20px auto;
  max-width: 900px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  flex-wrap: wrap; /* Supaya responsive di skrin kecil */
}

.center-text {
  text-align: center;
  font-size: 16px;
  font-weight: bold;
  color: #333;
}

.transparent-box {
  background-color: rgba(255, 255, 255, 0.8);
  padding: 10px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  max-width: 600px;
  margin: 0 auto;
}

.teks-bergerak {
  overflow: hidden;
}

.teks-scroll {
  white-space: normal;
  animation: none;
  transform: none;
}
.info-table {
  width: 100%;
  border-collapse: collapse;
  background-color: #ffffff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.info-table tr:nth-child(even) {
  background-color: #f0f8ff; /* biru muda */
}

.info-table td {
  padding: 15px 20px;
  border-bottom: 1px solid #ddd;
  font-size: 16px;
  color: #333;
}

.info-table td:first-child {
  font-weight: bold;
  color: #4a4a4a;
  width: 60%;
}

.info-table td:last-child {
  text-align: right;
  font-weight: bold;
}

/* Tambah warna berdasarkan jenis data */
.info-table tr:nth-child(1) td:last-child {
  color: #007bff; /* Biru untuk total residence */
}

.info-table tr:nth-child(2) td:last-child {
  color: #28a745; /* Hijau untuk total reports */
}

.info-table tr:nth-child(3) td:last-child {
  color: #dc3545; /* Merah untuk pending */
}

  </style>
</head>
<body>

<?php include("headerAdmin.php"); ?>

<div>
  <img src="image/landscape.png" id="picture" style="width:100%; height:auto;">
</div>

<table class="info-table">
    <tr>
      <td><strong>Total Registered Residence:</strong></td>
      <td><?= $total_residence ?></td>
    </tr>
    <tr>
      <td><strong>Total Reports Submitted (All Users):</strong></td>
      <td><?= $total_reports ?></td>
    </tr>
    <tr>
      <td><strong>Pending Reports:</strong></td>
      <td><?= $pending_reports ?></td>
    </tr>
</table>


<main>
  <nav class="bawah">
    <h2 class="center-text">General</h2>
    <div class="button-group">
      <a class="select" href="report.php">Report</a>
      <a class="select" href="community.php">Announcement</a>
      <a class="select" href="admin.php">Admin</a>
    
    </div>
   
  </nav>
</main>

<?php include("footer.php"); ?>

</body>
</html>
