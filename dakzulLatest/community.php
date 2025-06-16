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
.announcement h3 {
  margin: 0;
  font-size: 1.2em;
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
  </style>
</head>
<body>
  <?php include("../header.php"); ?>
  <main>
    <section class="announcement-section">
      <h2>Community</h2>
        <div class="announcement">
          <img src="../image/bell .png .png" alt="bell" id="bell">
          <h3>No Announcement Yet!</h3>
        </div>
      </div>
    </section>
    <section class="community">
      <div class="user-info">
        <img src="../image/user.png" alt="user" class="user">
        <h3>Issac</h3>
      </div>
      <img src="../image/bilikIssac.png" alt="bilikIssac" id="bilik">
    </section>
  </main>
<?php include("../footer.php"); ?>
</body>
</html>
