


<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style>
        body {   
            font-family: Arial;
            background: #f2f2f7; 
            margin:0;
        }
        .header {
            background-color: #7B61FF;
            color: white;
            padding: 1px;
            display: flex;
            align-items: center;
            justify-content: flex-start; 
            gap: 20px; 
            font-family: Arial, sans-serif;
        }
       #text {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            display: block;
            width: 100%;
        }
        
        .partsatu{
            max-width: 500px;
            margin: 40px auto;
            background: white; padding: 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }
        .tajukpart{
            font-weight: bold;
            font-size: 27px;
            margin-bottom: 20px;
        }
        .profilepart {
            background-color: white;
            max-width: 500px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #d6ccff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

         .info {
            margin-top: 20px;
        }

       .info p {
            margin: 8px 0;
            font-size: 14px;
        }

       .info span {
           font-weight: bold;
        }
         .edit-button {
      background-color: #7B61FF;
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      display: block;
      margin: 20px auto 0 auto;
      font-size: 16px;
    }


       
    </style>
</head>
<body>

<div class="header">
    <h1 id="text">Profile</h1>
</div>

<div class="partsatu">
  <div class="tajukpart">Account Info</div>
    <img class="profilepart" src="<?php echo $user['profile_pic']; ?>" alt="Profile Picture">

    <div class="change-profile"><a href="change_profile.php?id=<?php echo $user_id; ?>">Change Profile</a></div>

    <div class="info">
      <p><span>Full Name:</span> 
      <p><span>Email:</span> 
      <p><span>Contact:</span> 
      <p><span>Address:</span> 
    </div>

    <button class="edit-button" onclick="window.location.href='edit_profile.php?id=<?php echo $user_id; ?>'">Edit</button>
  </div>

</body>
</html>