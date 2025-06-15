<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/burger.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>


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
  <a href="report.php"><i class="fas fa-file"></i> Report</a>
  <a href="#"><i class="fas fa-comment-dots"></i> Community</a>
  <a href="admin.php"><i class="fas fa-user-shield"></i> Admin</a>
  <a href="../dakzulLatest/logout.php">Log Out</a>
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