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
} nav a {
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
      max-height: 450px;
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
      <h1>Report</h1>
    </div>
    <nav class="topnav">
      <a href="main.php">Home</a>
      <div class="nav-right">
        <a href="makeReport.php">Profile</a>
        <a href="#"><img src="user.png" alt="User" class="user"></a>
      </div>
    </nav>
  </header>
</body>
</html>
