<?php
session_start();
include('connect.php');

// Cegah akses jika tak login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Dapatkan nama penuh dari table residence
$login_username = $_SESSION['username'];
$name = $login_username; // default

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/community.css" type="text/css">
  <title>Setia - Community</title>

</head>
<body>
  <?php include("burger.php"); ?>
  <div class="header">
    <h1 id="text">Community</h1>
    
</div>
  <main>
    <section class="announcement-section">
      <h2>Community</h2>
        <div class="announcement">
          <img src="bell.png" alt="bell" id="bell">
          <h3>No Announcement Yet!</h3>
        </div>
      </div>
    </section>

    <section class="community">
      <div class="user-info">
        <img src="user.png" alt="user" class="user">
        <h3>Issac</h3>
      </div>
      <img src="bilikIssac.png" alt="bilikIssac" id="bilik">
    </section>
  </main>
<?php include("footer.php"); ?>
</body>
</html>
