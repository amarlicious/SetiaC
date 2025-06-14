<?php
session_start();
include('connection.php');
include('head.php');

// Pastikan user sudah login
if (!isset($_SESSION['id'])) {
    echo "Access denied.";
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
    exit();
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM member WHERE id = $id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Done Submit</title>
  <link rel="stylesheet" href="../css/reportSubmit.css" type="text/css"/>
  <meta http-equiv="refresh" content="5; URL=../Project/home.php">
</head>

<body>
  <div class="head">
    <h1>Report</h1>
  </div>  

  <div class="main-content">
    <div class="bulatan">
      <img class="icon" src="../image/right icon.jpg" alt="Success Icon" />
    </div>

    <div class="text"><p>Report Submitted!</p></div>

    <button type="submit" class="home-button">
      <a href="../Project/home.php">Home</a>
    </button>
  </div>

  <section style="margin-top: 40px;">
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<center><h3>YOUR PROFILE</h3></center>";
            echo "<table align='center' border='1' width='50%'>";
            echo "<tr><th>Id: </th><td>" . htmlspecialchars($row['id']) . "</td></tr>";
            echo "<tr><th>Name: </th><td>" . htmlspecialchars($row['name']) . "</td></tr>";
            echo "<tr><th>Email: </th><td>" . htmlspecialchars($row['email']) . "</td></tr>";
            echo "<tr><th>Phone: </th><td>" . htmlspecialchars($row['phone']) . "</td></tr>";
            echo "<tr><th>Gender: </th><td>" . htmlspecialchars($row['gender']) . "</td></tr>";

            $picture = (!empty($row['picture']) && file_exists($row['picture'])) ? $row['picture'] : 'default.png';
            echo "<tr><th>Picture</th><td><img class='imgcenter' src='" . htmlspecialchars($picture) . "' alt='Profile Picture'></td></tr>";
            echo "</table>";
        }
    } else {
        echo "<p style='text-align: center;'>No results found.</p>";
    }

    $conn->close();
    ?>
  </section>
</body>
</html>
