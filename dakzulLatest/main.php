<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setia - General</title>
  <link rel="stylesheet" href="styles.css">
  <style>
.bawah h2 {
  font-family: 'Times New Roman', Times, serif;
  font-size: 50px;
  color: #654bd1;
  text-align: center;
  margin-top: 40px;
  margin-bottom: 30px;
}

.bawah a.select {
  color: #000;
  background-color: #eee;
  border: 2px solid #654bd1;
  border-radius: 30px;
  width: 250px;
  height: 220px;
  display: flex;
  justify-content: center; 
  align-items: center;     
  text-align: center;
  font-weight: bold;
  font-size: 30px;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  margin: 15px; /* ruang antara butang */
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.bawah a.select:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

main {
  padding: 20px;
  padding-bottom: 200px;
  text-align: center;
}
.button-group {
  display: flex;
  justify-content: center; 
  flex-wrap: wrap;         
  margin-top: 20px;
}
#picture
{
  width: 100%;
  height: 500px;
}

</style>
</head>
<?php include("../header.php");  ?>
<body>
  <div>
    <img src="../image/home.png" id="picture">
    
  </div>
  <main>
    <nav class="bawah">
      <h2>General</h2>
      <div class="button-group">
        <a class="select" href="../adminfile/report.php">Report</a>
        <a class="select" href="community.php">Community</a>
        <a class="select" href="../homepage/adminBaru.php">Admin</a>
      </div>
    </nav>
  </main>
<?php include("../footer.php");  ?>
</body>
</html>
