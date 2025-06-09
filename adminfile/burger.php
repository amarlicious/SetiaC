<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>burger</title>

    <link rel="stylesheet" href="../css/burger.css" type="text/css">
</head>
<body>
     <div class="burger-bg">
    <div class="burger" id="burger">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div class="sidebar" id="sidebar">
    <a href="#">Home</a>
    <a href="#">Profile</a>
    <a href="#">Settings</a>
    <a href="#">Logout</a>
  </div>
<script>
    const burger = document.getElementById('burger');
    const sidebar = document.getElementById('sidebar');

    burger.addEventListener('click', () => {
      burger.classList.toggle('active');
      sidebar.style.width = sidebar.style.width === '250px' ? '0' : '250px';
    });
  </script>
</body>
</html>