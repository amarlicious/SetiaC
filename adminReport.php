<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Report</title>
  <link rel="stylesheet" href="../css/adminReport.css" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>

  <?php include("burger.php"); ?>
  

  <div class="head">
    <h1>Admin</h1>
  </div>

  <div class="container">
    <div class="admin-sidebar">
      <p class="admin">Admin</p>
      <ul class="bawah-admin" id="bawah-admin">
        <li><a href="admin.php"><i class="fas fa-clock"></i> Update Status</a></li>
        <li><a href="report.php"><i class="fas fa-file"></i> Report</a></li>
        <li><a href="#"><i class="fas fa-comment-dots"></i> Community</a></li>
      </ul>
    </div>

    <div class="sebelah-admin">
      <h1>Report</h1>

      <form class="search" action="search.php" method="GET">
        <input type="text" name="search" placeholder="Search..." />
        <button type="submit">Search</button>
      </form>

      <?php
      if (isset($_GET['search'])) {
        $search = htmlspecialchars($_GET['search']);
        echo "You searched for: <strong>$search</strong>";
      }
      ?>
    </div>
  </div>

</body>
</html>
