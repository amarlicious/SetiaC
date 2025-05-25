<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Footer</title>

  <style>
    * {
      margin: 0;
      font-family: Arial, sans-serif;
      padding:0;
    }

    .footer {
      background-color: gray;
      color: white;
      text-align: center;
      padding: 20px 0;
      font-family:'Playfair Display',serif;
    }

    .footer h1 {
      margin: 0;
      padding-bottom: 10px;
    }

    .footer .foot {
    
      display: flex;
      justify-content: center;
      gap: 20px;
      color: black;
      padding: 50px;
    }

   
    .footer .copy {
   list-style-type:none;

    }
  </style>
</head>
<body>
  <div class="footer">
    <?php 
      $name = "Setia";
      echo "<h1>$name</h1>";
    ?>
    
    <ul class="foot">
    
    <li class="copy">&copy; 2025 Brand, Inc.</li>
    <li> Privacy </li>
    <li> Terms </li>
    <li> Sitemap </li>
       
    </ul>

   
  </div>
</body>
</html>
    