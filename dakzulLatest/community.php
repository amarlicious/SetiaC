<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setia - Announcement</title>
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
    .announcement-section h2 {
      background-color: #8c8cff;
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
  </style>
</head>
<body>
  <?php include("header.php"); ?>
  <main>
    <section class="announcement-section">
      <h2>Community</h2>
      <div class="announcement">
        <img src="bell (1).png" alt="bell" id="bell">
        <h3>No Announcement Yet!</h3>
      </div>
    </section>

    <section class="community">
      <div class="user-info">
        <img src="user.png" alt="user" class="user">
        <h3>Issac</h3>
      </div>
      <img src="bilikIssac.png" alt="bilikIssac" id="bilik">

      <!-- Chat messages from database -->
      <div class="chat-box">
        <?php
          $conn = new mysqli("localhost:3301", "root", "1234", "setia");
          $result = $conn->query("SELECT * FROM chat ORDER BY timestamp DESC");
          while($row = $result->fetch_assoc()) {
            echo "<div class='chat-message'>";
            echo "<strong>" . htmlspecialchars($row['user_name']) . ":</strong><br>";
            echo nl2br(htmlspecialchars($row['message'])) . "<br>";
            if (!empty($row['image_path'])) {
              echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='gambar'>";
            }
            echo "</div>";
          }
          $conn->close();
        ?>
      </div>

      <!-- Chat form -->
      <form action="chat_process.php" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
        <textarea name="message" rows="3" placeholder="Type your message.." style="width: 100%; padding: 10px; border-radius: 8px;"></textarea>
        <input type="file" name="image" accept="image/*" style="margin-top: 10px;">
        <button type="submit" style="margin-top: 10px; padding: 10px 20px; border: none; background-color: #8c8cff; color: white; border-radius: 8px;">Submit</button>
      </form>
    </section>
  </main>
  <?php include("footer.php"); ?>
</body>
</html>