<?php
session_start();
require_once '../dakzulLatest/connect.php'; 

// Pastikan pengguna telah log masuk
if (!isset($_SESSION['username'])) { 
    echo "Akses ditolak. Sila log masuk.";
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
    exit();
}

$feedback_details = null;

// Semak jika feedback_id wujud dalam URL
if (isset($_GET['feedback_id'])) {
    $feedback_id = $_GET['feedback_id'];

    // Dapatkan maklum balas berdasarkan ID
    $sql = "SELECT id, Username, text, date FROM feedback WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $feedback_id); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $feedback_details = $result->fetch_assoc();
        } else {
            echo "<p style='color: red; text-align: center;'>Maklum balas tidak ditemui dalam sistem.</p>";
        }
        $stmt->close();
    } else {
        echo "<p style='color: red; text-align: center;'>Ralat SQL: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: red; text-align: center;'>ID maklum balas tidak diberikan.</p>";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Feedback Submission</title>
    <link rel="stylesheet" href="../css/reportSubmit.css" />
    <style>
        .report-summary {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            line-height: 1.6;
        }
        .report-summary p {
            margin-bottom: 8px;
        }
        .report-summary strong {
            display: inline-block;
            width: 100px;
            vertical-align: top;
        }
        .report-summary span {
            display: inline-block;
            width: calc(100% - 110px);
            vertical-align: top;
        }
        .report-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin-top: 15px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .center-text {
            text-align: center;
        }
        .report-summary h2 {
            margin-top: 0;
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .home-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .home-button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

    <div class="head">
        <h1>Report Submit</h1>
    </div>

    <div class="main-content">
        <div class="bulatan">
            <img class="icon" src="../image/right icon.jpg" alt="Success" />
        </div>
        <div class="text center-text">
            <p><strong>Feedback Submitted Successfully!</strong></p>
        </div>
    </div>

    <?php if ($feedback_details): ?>
    <div class="report-summary">
        <h2>Maklum Balas Anda</h2>
        <p><strong>ID:</strong> <span><?= htmlspecialchars($feedback_details['id']) ?></span></p>
        <p><strong>Nama:</strong> <span><?= htmlspecialchars($feedback_details['Username']) ?></span></p>
        <p><strong>Mesej:</strong> <span><?= nl2br(htmlspecialchars($feedback_details['text'])) ?></span></p>
        <p><strong>Tarikh:</strong> <span><?= htmlspecialchars($feedback_details['date']) ?></span></p>
    </div>
    <?php endif; ?>

    <div>
        <a href="../dakzulLatest/main.php"><button class="home-button">Home</button></a>
    </div>

</body>
</html>
