<?php
session_start();
include('connect.php');

// Tak login takleh akses
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Dapat nama user
$login_username = $_SESSION['username'];
$name = $login_username;

$sql = "SELECT name FROM residence WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login_username);
$stmt->execute();
$result = $stmt->get_result();
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
}
$stmt->close();

// Semak jika user ialah admin
$is_admin = ($login_username === 'admin'); // Tukar 'admin' ke username sebenar admin kalau perlu
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="refresh" content="5">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setia - Community</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #fefefe;
      color: #333;
    }
    main {
      padding: 20px;
      max-width: 700px;
      margin: 0 auto;
    }
    .head {
      background-color: #7B61FF;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
      color: white;
      font-size: 24px;
      width: 100%;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    #text {
      font-size: 40px;
      font-weight: bold;
      text-align: center;
      display: block;
      width: 100%;
    }
    .announcement-section h2 {
      background-color: #7B61FF;
      color: white;
      text-align: center;
      padding: 15px;
      font-size: 2em;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
      margin-top: 0;
    }
    .announcement {
      background-color: white;
      border-radius: 16px;
      padding: 15px;
      display: flex;
      align-items: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }
    #bell {
      width: 30px;
      margin-right: 10px;
    }
  </style>
</head>
<body>

<?php include("burger.php"); ?>

<div class="head">
  <h1 id="text">Community</h1>
</div>

<main>
  <section class="announcement-section">
    <h2>Announcement</h2>

    <?php
    // Dapatkan announcement dari DB (optional kalau nak guna database)
    $announcement_result = $conn->query("SELECT * FROM announcements ORDER BY created_at DESC LIMIT 1");
    if ($announcement_result && $announcement_result->num_rows > 0) {
        while ($row = $announcement_result->fetch_assoc()) {
            echo "<div class='announcement'>";
            echo "<img src='image/bell.png' alt='bell' id='bell'>";
            echo "<h3>" . htmlspecialchars($row['message']) . "</h3>";
            echo "</div>";
        }
    } else {
        echo "<div class='announcement'>";
        echo "<img src='image/bell.png' alt='bell' id='bell'>";
        echo "<h3>No Announcement Yet!</h3>";
        echo "</div>";
    }
    ?>
  </section>
</main>

<?php include("footer.php"); ?>
</body>
</html>
