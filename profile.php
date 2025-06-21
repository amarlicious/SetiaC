<?php
session_start();
include('connect.php');


if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM residence WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    echo "<div class='message'>User not found.</div>";
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="css/profile.css" type="text/css">
    <title>Profile</title>
    
</head>
<body>

<div class="header">
    <h1 id="text">Profile</h1>
    
</div>
<p id="role"><span" >Username: </span><?=htmlspecialchars(string: $user['username'])?></p>
<p id="role"><span" >ROLE: </span><?=htmlspecialchars(string: $user['role'])?></p>


<div class="partsatu">
  <div class="tajukpart">Account Info</div>

    <img class="profilepart" src="<?php echo $user['picture']; ?>" alt="Profile Picture">

  <div class="info">
    <p><span>Full Name:</span> <?= htmlspecialchars($user['name']) ?></p>
    <p><span>Email:</span> <?= htmlspecialchars($user['email']) ?></p>
    <p><span>Contact:</span> <?= htmlspecialchars($user['phone']) ?></p>
  </div>

  <a href="edit.php" class="edit-button">Edit</a>
  <a href="main.php" class="edit-button">Home</a>
</div>

<div class="content">
    <a href="logout.php" id="logout-button">Log Out</a>
</div>

</body>
</html>