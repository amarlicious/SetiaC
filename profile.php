<?php
session_start();
include('connect.php');

//semak user log in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

//simpan nama user
$username = $_SESSION['username'];

//untuk elak injection
$sql = "SELECT * FROM residence WHERE username = ?";
$stmt = $conn->prepare($sql); // statement kosong
$stmt->bind_param("s", $username); //ambil username 
$stmt->execute(); // jalankan
$result = $stmt->get_result(); //dapatkan result

//semak user
if ($result && $result->num_rows == 1) {
    $user = $result->fetch_assoc(); //ambil info tu
} else {
    // Styling untuk user not found
    echo "
    <div style='
        margin: 100px auto;
        max-width: 400px;
        background-color: #ffe6e6;
        color: #b30000;
        padding: 30px;
        text-align: center;
        font-family: Segoe UI, sans-serif;
        border: 2px solid #ff9999;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    '>
        <h2 style='margin-bottom: 10px;'> User Not Found</h2>
        <p>We couldn't find your profile in the system.</p>
        <a href='main.php' style='
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #7B61FF;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        '>Go Back</a>
    </div>
    ";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .header {
            background-color: #7B61FF;
            padding: 20px;
            text-align: center;
            color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        #text {
            font-size: 28px;
            margin: 0;
        }

        #role {
            text-align: center;
            font-size: 16px;
            margin-top: 10px;
        }

        .partsatu {
            background-color: white;
            max-width: 500px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }

        .tajukpart {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #7B61FF;
        }

        .profilepart {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #7B61FF;
        }

        .info {
            text-align: left;
            margin-top: 15px;
        }

        .info p {
            margin: 10px 0;
            font-size: 16px;
        }

        .info span {
            font-weight: bold;
            color: #555;
        }

        .edit-button {
            display: inline-block;
            margin: 15px 10px 0;
            padding: 10px 20px;
            background-color: #7B61FF;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .edit-button:hover {
            background-color: #5b47d1;
        }

        #logout-button {
            display: block;
            width: 200px;
            margin: 30px auto;
            padding: 10px;
            background-color: #ff4d4f;
            color: white;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        #logout-button:hover {
            background-color: #cc3b3e;
        }
    </style>
</head>
<body>

<div class="header">
    <h1 id="text">Profile</h1>
</div>

<p id="role"><span>Username:</span> <?= htmlspecialchars($user['username']) ?></p>

<div class="partsatu">
    <div class="tajukpart">Account Info</div>

    <img class="profilepart" src="<?= htmlspecialchars($user['picture'] ?: 'uploads/default.jpg') ?>" alt="Profile Picture">

    <!-- paparan -->
    <div class="info">
        <p><span>Full Name:</span> <?= htmlspecialchars($user['name']) ?></p>
        <p><span>Email:</span> <?= htmlspecialchars($user['email']) ?></p>
        <p><span>Contact:</span> <?= htmlspecialchars($user['phone']) ?></p>
        <p><span>Unit No:</span> <?= htmlspecialchars($user['unit']) ?></p>
    </div>

    <!-- button -->
    <a href="edit.php" class="edit-button">Edit</a>
    <a href="main.php" class="edit-button">Home</a>
</div>

<!-- <div class="content">
    <a href="logout.php" id="logout-button">Log Out</a>
</div> -->

</body>
</html>
