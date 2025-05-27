<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    
    <link rel="stylesheet" href="../css/admin.css" type="text/css">

   
</head>
<body>
    
    <div class="container">
        <div class="admin-sidebar" >
            <p class="admin">Admin</p>
            <ul>
                <li id="Home"><a href="../Project/home.php">Home</a></li>
                <li id="Report">Report</li>
                <li id="message">Message</li>
                <li id="setting"><a href="../Project/setting.php">Setting</a></li>
            </ul>
        </div>

        <div class="sebelah-admin">
            <h1>Message</h1>

        <form class="search" action="search.php" method="GET">
        <input type="text" name="search" placeholder="Search...">
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
    
</body></footer>
</html>