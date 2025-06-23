<?php
session_start();
include('connect.php');

// tak login tklee akses
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// dapat nama user dr db
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
    .community {
      background: white;
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }
    .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 10px;
    }
    .user-info img.user {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }
    .user-info h3 {
      margin: 0;
      font-weight: bold;
      font-size: 1.1em;
    }
    #bilik {
      width: 100%;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .chat-box {
      margin-top: 20px;
    }
    .chat-message {
      background: #f2f2f2;
      padding: 10px;
      border-radius: 8px;
      margin-top: 10px;
    }
    .chat-message img {
      max-width: 100%;
      border-radius: 8px;
      margin-top: 10px;
    }
    textarea {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
    }
    button {
      margin-top: 10px;
      padding: 10px 20px;
      border: none;
      background-color: #7B61FF;
      color: white;
      border-radius: 8px;
    }
    button:hover {
      background-color: #d50909;
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

      <div class="announcement">
        <img src="image/bell.png" alt="bell" id="bell">
        <h3>No Announcement Yet!</h3>
      </div>
    </section>

    <section class="community">
      

      <div class="chat-box">
        <?php
        $result = $conn->query("SELECT * FROM chat ORDER BY timestamp DESC");
        while ($row = $result->fetch_assoc()) {
          echo "<div class='chat-message'>";
          echo "<strong>" . htmlspecialchars($row['user_name']) . ":</strong><br>";
          echo nl2br(htmlspecialchars($row['message'])) . "<br>";
          if (!empty($row['image_path'])) {
            echo "<img src='" . htmlspecialchars($row['image_path']) . "' width='200'>";
          }
          echo "</div><hr>";
        }
        ?>
      </div>

      <form action="chat_process.php" method="POST" enctype="multipart/form-data">
        <textarea name="message" rows="3" placeholder="Type your message.." required></textarea><br>
        <button type="submit">Submit</button>
      </form>
    </section>
  </main>
  <?php include("footer.php"); ?>
</body>
</html>
