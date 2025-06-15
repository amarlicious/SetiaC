<?php
session_start();
include('connection.php');

if (!isset($_SESSION['last_report_id'])) {
    echo "No report found.";
    echo "<meta http-equiv='refresh' content='3; URL=report.php'>";
    exit();
}

$report_id = $_SESSION['last_report_id'];
$sql = "SELECT * FROM report WHERE id = $report_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Report Submitted</title>
  <link rel="stylesheet" href="../css/reportSubmit.css" />
</head>
<body>
  <div class="head">
    <h1>Report Submitted</h1>
  </div>

  <div class="main-content">
    <div class="bulatan">
      <img class="icon" src="../image/right icon.jpg" alt="Success" />
    </div>
    <div class="text">
      <p>Report Successfully Submitted!</p>
    </div>

    <a href="../Project/home.php"><button class="home-button">Home</button></a>
  </div>

  <section style="margin-top: 40px;">
    <?php
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<center><h3>YOUR REPORT</h3></center>";
        echo "<table align='center' border='1' width='50%'>";
        echo "<tr><th>Text</th><td>" . htmlspecialchars($row['report_text']) . "</td></tr>";
        echo "<tr><th>Category</th><td>" . htmlspecialchars($row['category']) . "</td></tr>";

        $img = (!empty($row['picture']) && file_exists($row['picture'])) ? $row['picture'] : 'default.png';
        echo "<tr><th>Picture</th><td><img src='" . htmlspecialchars($img) . "' width='150' /></td></tr>";
        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>Report not found.</p>";
    }
    $conn->close();
    ?>
  </section>
</body>
</html>
