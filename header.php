<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Header</title>
  <style>
    * {
      margin: 0;
      padding: 0;
    
      
    }

    .head {
     background-color: #7B61FF;
     color: white;
     padding: 20px;
     display: flex;
     align-items: center;
     justify-content: flex-start; 
     gap: 20px; 
     font-family: Arial, sans-serif;
}

    #setia {
      font-size: 40px;
      font-weight: bold;
    }

    .tagline {
      display: flex;
      flex-direction: column;

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


    .nav
    {
        display: flex;
        flex-direction:row ;
        gap: 20px;
        list-style-type: none;
        justify-content: end;
        margin-left: auto;
        cursor: pointer;
    } 

    .nav li a
    {
        text-decoration: none;
        color: white;

    } 
   

    nav ul li a:hover
    {
        background: blue;
        text-decoration: underline;

    }
    
    .menu
    {
        margin-left: auto;
    }
    
    .logout {
      background-color: #e63946; /* warna merah terang */
  color: white;
  padding: 8px 16px;
  border-radius: 8px;
  text-transform: uppercase;
  font-weight: bold;
  transition: background-color 0.3s ease;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.logout:hover {
  background-color: #d62828; /* warna lebih gelap bila hover */
  cursor: pointer;
  text-decoration: none;
}
    
  </style>
</head>
<body>
  <div class="head">
    <h1 id="setia">Setia</h1>

    <div class="tagline">
      <p id="stay">Stay Together. Stay Setia</p>

      <ul class="word">
        <li class="no1">live</li>
        <li class="no2">learn</li>
        <li class="no3">work</li>
        <li class="no4">play</li>
      </ul>

   
    </div>

     <nav class="menu">
    <ul class="nav">

    <li><a href="../dakzulLatest/main.php">Home</a></li>
    <li><a href="../homepage/profile.php">Profile</a></li>
    <li><a href="../homepage/history.php">History</a></li>
    <li><a href="../dakzulLatest/logout.php"><span class="logout">LOG OUT</span></a></li>
    
    </ul>
    </nav>

  
  </div>


</body>
</html>

