<?php
session_start();
require_once('connect.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: nonAdmin.php");
    exit();
}

$residence_list = [];
$total_residence = 0;

$sql = "SELECT * FROM residence ORDER BY id ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $residence_list[] = $row;
    }
    $total_residence = count($residence_list);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Residents</title>
    <style>
        * {
            box-sizing: border-box;
        font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            padding: 20px;
            background-color: #f0f4f8;
        }

        .container2 {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }

        .center-text {
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 25px;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
        }

        .report-table th, .report-table td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: center;
        }

        .report-table th {
            background-color: #7B61FF;
            color: white;
            font-weight: 500;
        }

        .report-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .report-table tr:hover {
            background-color: #f1f1f1;
        }

        img {
            border-radius: 50%;
            object-fit: cover;
            height: 50px;
            width: 50px;
        }



            .center-text {
                font-size: 18px;
            }
        .edit-button {
            background-color: #7B61FF;
            color: white;
            padding: 6px 16px;        
            border-radius: 8px;
            cursor: pointer;
            display: inline-block;
            margin: 20px auto;
            font-size: 14px;         
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
        }

    .edit-button:hover {
        background-color: purple;
    }

#button-back {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

        
    </style>
</head>
<body>
    <div class="container2">
        <p class="center-text">Total Registered Residence: <?= $total_residence ?></p>

        <?php if (!empty($residence_list)): ?>
            <table class="report-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($residence_list as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['phone']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="center-text">No users found.</p>
        <?php endif; ?>
    </div>
    <div id="button-back"> <a href="admin.php" class="edit-button">Back</a></div>
  
</body>
</html>

