<?php
session_start();
require_once '../dakzulLatest/connect.php'; 

// Semak sama ada pengguna sudah log masuk
if (!isset($_SESSION['username'])) { 
    echo "Akses ditolak. Sila log masuk.";
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
    exit();
}

$username = $_SESSION['username'];
$report_list = [];
$total_reports = 0;

// Dapatkan semua laporan oleh pengguna yang log masuk
$sql = "SELECT r.*, res.username AS reporter_username 
        FROM reports r 
        JOIN residence res ON r.user_id = res.id 
        WHERE res.username = ? 
        ORDER BY r.report_date DESC";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $report_list[] = $row;
    }

    // Kira jumlah laporan
    $total_reports = count($report_list);

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
    <title>Report History</title>
    <link rel="stylesheet" href="../css/reportSubmit.css" />
    <style>
        .report-summary {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            max-width: 700px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            line-height: 1.6;
        }
        .report-summary p {
            margin-bottom: 8px;
        }
        .report-summary strong {
            display: inline-block;
            width: 110px;
            vertical-align: top;
        }
        .report-summary span {
            display: inline-block;
            width: calc(100% - 120px);
        }
        .report-image {
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
    </style>
</head>
<body>
    <div class="head">
        <h1>Report History</h1>
    </div>

    <div class="main-content">
        <?php if (!empty($report_list)): ?>
            <h2 class="center-text">All Your Reports</h2>
            <h3 class="center-text">Total Reports Submitted: <?= $total_reports ?></h3>
            <?php foreach ($report_list as $report): ?>
                <div class="report-summary">
                    <p><strong>Report's ID:</strong> <span><?= htmlspecialchars($report['report_id']) ?></span></p>
                    <p><strong>User:</strong> <span><?= htmlspecialchars($report['reporter_username']) ?></span></p>
                    <p><strong>Date:</strong> <span><?= htmlspecialchars(date('d M Y, H:i A', strtotime($report['report_date']))) ?></span></p>
                    <p><strong>Category:</strong> <span><?= htmlspecialchars($report['category']) ?></span></p>
                    <p><strong>Report:</strong> <span><?= nl2br(htmlspecialchars($report['report_text'])) ?></span></p>
                    <p><strong>Status:</strong> 
                        <span class="<?= ($report['status'] == 'Solved') ? 'status-solved' : 'status-pending'; ?>">
                            <?= htmlspecialchars($report['status']) ?>
                        </span>
                    </p>
                    <?php if (!empty($report['image_path'])): ?>
                        <p><strong>Picture:</strong></p>
                        <img src="<?= htmlspecialchars($report['image_path']) ?>" alt="Report Image" class="report-image" />
                    <?php else: ?>
                        <p><strong>Picture:</strong> <span>No picture uploaded.</span></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center; color: gray;">No reports found.</p>
        <?php endif; ?>
    </div>

    <div class="center-text">
        <a href="../dakzulLatest/main.php"><button class="home-button">Home</button></a>
    </div>
</body>
</html>
