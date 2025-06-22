<?php
session_start();
require_once 'connect.php'; 

// Semak sama ada pengguna sudah log masuk
if (!isset($_SESSION['username'])) { 
    echo "Akses ditolak. Sila log masuk.";
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
    exit();
}

$username = $_SESSION['username']; // Username dari sesi log masuk
$feedback_list = [];
$total_feedback = 0;

// Dapatkan semua feedback oleh pengguna yang log masuk
// Table: feedback (Id, Username, Text, Date)
// Kita akan filter berdasarkan Username dalam session
$sql = "SELECT Id, Username, Text, Date 
        FROM feedback 
        WHERE Username = ? 
        ORDER BY Date DESC, Id ASC"; // Urutkan ikut tarikh terkini dan ID

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $username); // Bind username dari sesi
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $feedback_list[] = $row;
    }

    // Kira jumlah feedback
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
    <title>Feedback History</title>
    <link rel="stylesheet" href="css/reportSubmit.css" /> 
    <style>
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
            width: 90px; /* Adjust width as needed */
            vertical-align: top;
        }
        .feedback-summary span {
            display: inline-block;
            width: calc(100% - 100px); /* Adjust width to fit */
        }
        .center-text {
            text-align: center;
        }
        h2, h3 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <?php
    include "burger.php";

    ?>
    <div class="head">
        <h1>Feedback History</h1>
    </div>

    <div class="main-content">
        <?php if (!empty($feedback_list)): ?>
            <h2 class="center-text">Your Submitted Feedback</h2>
            <h3 class="center-text">Total Feedback Submitted: <?= $total_feedback ?></h3>
            <?php foreach ($feedback_list as $feedback): ?>
                <div class="feedback-summary">
                    <p><strong>ID:</strong> <span><?= htmlspecialchars($feedback['Id']) ?></span></p>
                    <p><strong>User:</strong> <span><?= htmlspecialchars($feedback['Username']) ?></span></p>
                    <p><strong>Date:</strong> <span><?= htmlspecialchars(date('d M Y, H:i A', strtotime($feedback['Date']))) ?></span></p>
                    <p><strong>Feedback:</strong> <span><?= nl2br(htmlspecialchars($feedback['Text'])) ?></span></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center; color: gray;">No feedback found for your account.</p>
        <?php endif; ?>
    </div>

    <div class="center-text">
        <a href="main.php"><button class="home-button">Home</button></a>
    </div>
</body>
</html>