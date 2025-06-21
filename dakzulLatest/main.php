<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setia - General</title>
  <link rel="stylesheet" href="styles.css">
  <style>


body {
  margin: 0;
  padding: 0;
  font-family: 'Montserrat', sans-serif;
  background-color: #f7f6fd;
}

.bawah h2 {
  font-size: 50px;
  color: #654bd1;
  text-align: center;
  margin-top: 40px;
  margin-bottom: 30px;
  text-shadow: 2px 2px 5px rgba(101, 75, 209, 0.2);
}

.bawah a.select {
  color: #fff;
  background: linear-gradient(145deg, #7B61FF, #4e31c9);
  border: none;
  border-radius: 20px;
  width: 250px;
  height: 220px;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  font-weight: bold;
  font-size: 26px;
  font-family: 'Montserrat', sans-serif;
  margin: 15px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  box-shadow: 0 8px 20px rgba(123, 97, 255, 0.3);
  text-decoration: none;
}

.bawah a.select:hover {
  transform: translateY(-5px) scale(1.05);
  box-shadow: 0 12px 24px rgba(101, 75, 209, 0.4);
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

#picture {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-bottom: 6px solid #654bd1;
}


  .bawah h2 {
    font-size: 36px;
  }

  #picture {
    height: 350px;
  }

</style>


</head>
<?php include("../header.php");  ?>
<body>
  <div>
    <img src="../image/landscape.png" id="picture">
    
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
