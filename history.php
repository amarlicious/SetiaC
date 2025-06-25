<?php
session_start();
require_once 'connect.php'; 

// Semak sama ada pengguna sudah log masuk
if (!isset($_SESSION['username'])) { 
    echo "Akses ditolak. Sila log masuk.";
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
    exit();
}

$username = $_SESSION['username'];
$report_list = []; 
$total_reports = 0;

$nakSearch = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : null;

if ($nakSearch) {
    $sql = "SELECT r.*, res.username AS reporter_username, adminDesc 
            FROM reports r 
            JOIN residence res ON r.user_id = res.id 
            WHERE res.username = ? AND r.category LIKE ? 
            ORDER BY r.report_date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $nakSearch);
} else {
    $sql = "SELECT r.*, res.username AS reporter_username
            FROM reports r 
            JOIN residence res ON r.user_id = res.id 
            WHERE res.username = ? 
            ORDER BY r.report_date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
}

if ($stmt) {
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    while ($row = $result->fetch_assoc()) {
        $report_list[] = $row;
    }

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
    <link rel="stylesheet" href="css/admin.css" type="text/css" />
    <link rel="stylesheet" href="css/history.css" type="text/css" />
    <title>Report History</title>
    <style>
        .delete-button {
          background-color: #d9534f;
          color: white;
          padding: 8px 16px;
          border: none;
          border-radius: 6px;
          font-weight: bold;
          cursor: pointer;
          margin-top: 10px;
          transition: background-color 0.3s ease;
        }

        .delete-button:hover {
          background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="head">
        <h1 id="text">Report History</h1>
    </div>

    <form method="GET" class="center-text">
        <input type="text" name="search" placeholder="Search your report..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit">Search</button>
    </form>

    <div class="main-content">
        <?php if (!empty($report_list)): ?>
            <h2 class="center-text">All Your Reports</h2>
            <h3 class="center-text">Total Reports Submitted: <?= $total_reports ?></h3>
            <?php foreach ($report_list as $report): ?>
                <div class="report-summary">
                    <p><strong>Report's ID:</strong> <span><?= htmlspecialchars($report['report_id']) ?></span></p>
                    <p><strong>User:</strong> <span><?= htmlspecialchars($report['reporter_username']) ?></span></p>
                    <p><strong>Unit No:</strong> <span><?= htmlspecialchars($report['unit']) ?></span></p>
                    <p><strong>Date:</strong> <span><?= htmlspecialchars(date('d M Y, H:i A', strtotime($report['report_date']))) ?></span></p>
                    <p><strong>Category:</strong> <span><?= htmlspecialchars($report['category']) ?></span></p>
                    <p><strong>Report:</strong> <span><?= nl2br(htmlspecialchars($report['report_text'])) ?></span></p>
                    <?php
                        $statusClass = '';
                        switch ($report['status']) {
                        case 'Solved':
                        $statusClass = 'status-solved';
                        break;
                        case 'Progress':
                        $statusClass = 'status-progress';
                        break;
                        case 'Review':
                        default:
                        $statusClass = 'status-review';
                        break;
                    }
                    ?>
                  <p><strong>Status:</strong> 
                        <span class="<?= $statusClass ?>">
                        <?= htmlspecialchars($report['status']) ?>
                        </span>
                    </p>
                    <?php if (!empty($report['image_path'])): ?>
                        <p><strong>Picture:</strong></p>
                        <img src="<?= htmlspecialchars($report['image_path']) ?>" alt="Report Image" class="report-image" />
                    <?php else: ?>
                        <p><strong>Picture:</strong> <span>No picture uploaded.</span></p>
                    <?php endif; ?>

                    <form action="delete_report.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this report?');">
                        <input type="hidden" name="report_id" value="<?= htmlspecialchars($report['report_id']) ?>">
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center; color: gray;">No reports found.</p>
        <?php endif; ?>
    </div>

    <div class="center-text">
        <a href="main.php"><button class="home-button">Home</button></a>
    </div>
</body>
</html>