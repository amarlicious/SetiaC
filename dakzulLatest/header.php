<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Header</title>
  <style>
    *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
} 
.tagline {
      display: flex;
      flex-direction: column;
      margin-right: 1250px;
    }

    #stay {
      font-size: 18px;
      margin-bottom: 5px;
    }

    .word {
      display: flex;
      gap: 5px;
      font-weight: bold;
    }

    .word li {
      list-style: none;
    }

    .no1 {
      color: limegreen;
    }

    .no2 {
      color: hotpink;
    }

    .no3 {
      color: aqua;
    }

    .no4 {
      color: orange;
    }
nav a {
  margin-left: 40px;
  color: white;
  text-decoration: none;
  font-weight: bold;
}
.topnav {
  display: flex;
  align-items: center;
}

.nav-right {
  display: flex;
  align-items: center;
}
    header {
  background-color: #7B61FF;
  color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
}
img{
      display: block;
    }
    #landscape {
      width: 100%;
      max-height: 350px;
      object-fit: cover;
      display: block;
    }
    .user {
  width: 30px;
  height: 30px;
  border-radius: 50%;
}
  </style>
</head>
<body>
  <header class="header">
      <h1>Setia</h1>
      <div class="tagline">
      <p id="stay">Stay Together. Stay Setia</p>

      <ul class="word">
        <li class="no1">live</li>
        <li class="no2">learn</li>
        <li class="no3">work</li>
        <li class="no4">play</li>
      </ul>
    </div>
    <nav class="topnav">
      <a href="main.php">Home</a>
      <div class="nav-right">
        <a href="makeReport.php">Profile</a>
        <a href="#"><img src="user.png" alt="User" class="user"></a>
      </div>
    </nav>
  </header>
  <div>
      <img src="landscape.png" id="landscape">
    </div>
</body>
</html>
