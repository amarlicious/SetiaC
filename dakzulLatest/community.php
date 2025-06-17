<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
      max-width: 800px;
      margin: 0 auto;
    }

    .announcement-section {
      margin-bottom: 40px;
    }

    .announcement-section h2 {
      background-color: #8c8cff;
      color: white;
      text-align: center;
      padding: 15px;
      font-size: 2em;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
      margin: 0;
    }

    .announcement {
      background-color: white;
      border-radius: 0 0 16px 16px;
      padding: 15px;
      display: flex;
      align-items: center;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .announcement img {
      width: 30px;
      height: 30px;
      margin-right: 10px;
    }

    .announcement h3 {
      margin: 0;
      font-size: 1.2em;
    }

    .community {
      background: white;
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
      max-height: 400px;
      object-fit: cover;
      border-radius: 8px;
    }

    @media (max-width: 600px) {
      .announcement-section h2 {
        font-size: 1.5em;
      }

      .announcement h3 {
        font-size: 1em;
      }
    }
  </style>
</head>
<body>
  <?php include("header.php"); ?>
  
  <main>
    <section class="announcement-section">
      <h2>Community Announcements</h2>
      <div class="announcement">
        <img src="bell (1).png" alt="Notification Bell Icon" />
        <h3>No Announcements Yet!</h3>
      </div>
    </section>

    <section class="community">
      <div class="user-info">
        <img src="user.png" alt="Profile picture of Issac" class="user" />
        <h3>Issac</h3>
      </div>
      <img src="bilikIssac.png" alt="Room shared by Issac" id="bilik" />
    </section>
  </main>

  <?php include("footer.php"); ?>
</body>
</html>
