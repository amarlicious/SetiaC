<?php
session_start();
include('connect.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$login_username = $_SESSION['username'];
$is_admin = ($login_username === 'admin'); // Ensure this is your actual admin username



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['announcement_message'])) {
    $announcement_message = trim($_POST['announcement_message']);

    if (!empty($announcement_message)) {
        $insert_sql = "INSERT INTO announcements (message) VALUES (?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("s", $announcement_message);

        if ($insert_stmt->execute()) {
            header("Location: community.php?status=success");
            exit();
        } else {
            header("Location: community.php?status=error");
            exit();
        }
        $insert_stmt->close();
    } else {
        header("Location: community.php?status=empty");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setia - Make Announcement</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #fefefe;
            color: #333;
        }
        main {
            padding: 20px;
            max-width: 700px;
            margin: 0 auto;
        }
        .head {
            background-color: #7B61FF;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            color: white;
            font-size: 24px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        #text {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            display: block;
            width: 100%;
        }
        .admin-form-container {
            background-color: #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .admin-form-container h3 {
            color: #333;
            margin-top: 0;
            text-align: center;
            margin-bottom: 20px;
        }
        .admin-form-container textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            min-height: 120px;
        }
        .admin-form-container button {
            background-color: #7B61FF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            display: block;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        .admin-form-container button:hover {
            background-color: #6a53d6;
        }
            .center-text form {
            margin: 20px auto;
            text-align: center;
        }

   

        .send-button {
    background-color: #7B61FF;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 25px;
    font-size: 1.1em;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: auto;
    margin-top: 30px;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

.send-button:hover {
    background-color: #d50909;
}
       
    </style>
</head>
<body>

<?php include("burger.php"); ?>

<div class="head">
    <h1 id="text">Make Announcement</h1>
</div>

<main>
    <section class="admin-form-container">
        <h3>Make an announcement for all users</h3>
        <form action="admin_announcement.php" method="POST">
            <textarea name="announcement_message" placeholder="Write your announcement here..." required></textarea>
            <button type="submit">Post Announcement</button>
        </form>
    </section>

  <div class="center-text">
   
        <a href="main.php"><button class="send-button">Home</button></a>
    </div>
</main>

<?php include("footer.php"); ?>
</body>
</html>