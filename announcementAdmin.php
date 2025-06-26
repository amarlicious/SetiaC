<?php
session_start();
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['announcement_message'])) {
    $announcement_message = trim($_POST['announcement_message']);

    if (!empty($announcement_message)) {
        $insert_sql = "INSERT INTO announcements (message) VALUES (?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("s", $announcement_message);

        if ($insert_stmt->execute()) {
            header("Location: community.php?status=success");
        } else {
            header("Location: community.php?status=error");
        }
        $insert_stmt->close();
        exit();
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
            padding: 20px;
        }
        .admin-form-container {
            background-color: #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin: 40px auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            max-width: 600px;
        }
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            min-height: 120px;
        }
        button {
            background-color: #7B61FF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #6a53d6;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #7B61FF;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="admin-form-container">
        <h1>Make Announcement</h1>
        <form method="POST">
            <textarea name="announcement_message" placeholder="Write your announcement here..." required></textarea>
            <button type="submit">Post Announcement</button>
        </form>
        <a href="community.php">Back to Community</a>
    </div>
</body>
</html>
