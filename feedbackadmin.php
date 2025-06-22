<?php
session_start();
require_once 'connect.php'; 

if (!isset($_SESSION['username'])) { 
    echo "Akses ditolak. Sila log masuk.";
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
    exit();
}

$feedback_list = [];
$total_feedback = 0;

$sql = "SELECT Id, Username, Text, Date 
        FROM feedback 
        ORDER BY Date DESC, Id ASC";

if ($stmt = $conn->prepare($sql)) {
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $feedback_list[] = $row;
    }

    $total_feedback = count($feedback_list);
    $stmt->close();
} else {
    echo "<p style='color: red; text-align: center;'>Ralat pangkalan data: " . $conn->error . "</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/admin.css" type="text/css" />
    <title>Feedback History</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }
        .feedback-summary {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            max-width: 700px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            line-height: 1.6;
        }
        .feedback-summary p {
            margin-bottom: 8px;
        }
        .feedback-summary strong {
            display: inline-block;
            width: 110px;
            vertical-align: top;
        }
        .feedback-summary span {
            display: inline-block;
            width: calc(100% - 120px);
        }
        .feedback-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin-top: 10px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .center-text {
            text-align: center;
        }
        h2, h3 {
            text-align: center;
            color: #333;
        }
        .status-pending {
            color: orange;
            font-weight: bold;
        }
        .status-solved {
            color: green;
            font-weight: bold;
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
        }
        #text {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            width: 100%;
        }
        .home-button {
            background-color: #7B61FF;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 30px auto;
        }
        .home-button:hover {
            background-color: #d50909;
        }
        .home-button a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    <?php include("burger.php");  ?>


    <div class="head">
        <h1 id="text">Feedback History</h1>
    </div>

    <div class="main-content">
        <?php if (!empty($feedback_list)): ?>
            <h2 class="center-text">All Submitted Feedback</h2>
            <h3 class="center-text">Total Feedback: <?= $total_feedback ?></h3>
            <?php foreach ($feedback_list as $feedback): ?>
                <div class="feedback-summary">
                    <p><strong>ID:</strong> <span><?= htmlspecialchars($feedback['Id']) ?></span></p>
                    <p><strong>User:</strong> <span><?= htmlspecialchars($feedback['Username']) ?></span></p>
                    <p><strong>Date:</strong> <span><?= htmlspecialchars(date('d M Y', strtotime($feedback['Date']))) ?></span></p>
                    <p><strong>Feedback:</strong> <span><?= nl2br(htmlspecialchars($feedback['Text'])) ?></span></p>
                   
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center; color: gray;">No feedback found.</p>
        <?php endif; ?>
    </div>

    <div class="center-text">
        <a href="main.php"><button class="home-button">Home</button></a>
    </div>
</body>
</html>