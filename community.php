<?php
session_start();
include('connect.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$login_username = $_SESSION['username'];

$sql = "SELECT name FROM residence WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login_username);
$stmt->execute();
$result = $stmt->get_result();
$name = $login_username;
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
}
$stmt->close();

$is_admin = ($login_username === 'admin');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="5">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setia - Community</title>
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
        }
        #text {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            display: block;
            width: 100%;
        }
        .announcement-section h2 {
            background-color: #7B61FF;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 2em;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            margin-top: 0;
        }
        .announcement {
            background-color: white;
            border-radius: 16px;
            padding: 15px;
            display: flex;
            align-items: flex-start;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            min-height: 80px;
        }
        #bell {
            width: 30px;
            flex-shrink: 0;
            margin-right: 10px;
            margin-top: 5px;
        }
        .announcement h3 {
            margin: 0;
            line-height: 1.4;
        }
        .admin-link-container {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #e6e6fa;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .admin-link-container p {
            margin-bottom: 10px;
            font-style: italic;
            color: #555;
        }
        .admin-link-container a {
            display: inline-block;
            background-color: #7B61FF;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .admin-link-container a:hover {
            background-color: #6a53d6;
        }
        .status-message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        .status-message.success {
            background-color: #d4edda;
            color: #155724;
        }
        .status-message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .status-message.empty {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>

<?php include("burger.php"); ?>

<div class="head">
    <h1 id="text">Community</h1>
</div>

<main>
    <?php if (isset($_GET['status'])): ?>
        <div class="status-message <?php echo htmlspecialchars($_GET['status']); ?>">
            <?php
                if ($_GET['status'] === 'success') echo "Announcement successfully added!";
                elseif ($_GET['status'] === 'error') echo "Error: Announcement could not be added.";
                elseif ($_GET['status'] === 'empty') echo "Announcement cannot be empty.";
            ?>
        </div>
    <?php endif; ?>

    <?php if ($is_admin): ?>
        <section class="admin-link-container">
            <p>You are logged in as Admin. Click below to make a new announcement.</p>
            <a href="announcementAdmin.php">Make New Announcement</a>
        </section>
    <?php endif; ?>

    <section class="announcement-section">
        <h2>Announcement</h2>

        <?php
        $announcement_result = $conn->query("SELECT message FROM announcements ORDER BY created_at DESC LIMIT 5");

        if ($announcement_result && $announcement_result->num_rows > 0) {
            while ($row = $announcement_result->fetch_assoc()) {
                echo "<div class='announcement'>";
                echo "<img src='image/bell.png' alt='bell' id='bell'>";
                echo "<h3>" . htmlspecialchars($row['message']) . "</h3>";
                echo "</div>";
            }
        } else {
            echo "<div class='announcement'>";
            echo "<img src='image/bell.png' alt='bell' id='bell'>";
            echo "<h3>No announcement right now.</h3>";
            echo "</div>";
        }
        ?>
    </section>
</main>

<?php include("footer.php"); ?>
</body>
</html>
