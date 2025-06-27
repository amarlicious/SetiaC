<?php
session_start();
include('connect.php');

// Semak jika pengguna adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); // Redirect jika bukan admin
    exit();
}

$message = '';

// Proses kelulusan/penolakan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $action = $_POST['action']; // 'approve' atau 'reject'

    if ($action === 'approve') {
        $updateSql = "UPDATE residence SET status = 'approved' WHERE id = ?";
    } elseif ($action === 'reject') {
        $updateSql = "UPDATE residence SET status = 'rejected' WHERE id = ?";
    } else {
        $message = "Invalid action.";
    }

    if (!empty($updateSql)) {
        if ($stmt = mysqli_prepare($conn, $updateSql)) {
            mysqli_stmt_bind_param($stmt, "i", $userId); // "i" untuk integer id
            if (mysqli_stmt_execute($stmt)) {
                $message = "User ID " . htmlspecialchars($userId) . " has been " . htmlspecialchars($action) . "d.";
            } else {
                $message = "Error updating user status: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            $message = "Error preparing update statement: " . mysqli_error($conn);
        }
    }
}

// Ambil senarai pengguna yang pending
$pendingUsers = [];
$sqlPending = "SELECT id, name, email, phone, unit, username FROM residence WHERE status = 'pending'";
if ($result = mysqli_query($conn, $sqlPending)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pendingUsers[] = $row;
    }
    mysqli_free_result($result);
} else {
    $message = "Error fetching pending users: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Approve Users</title>
    <style>
            body, html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }
        .message 
        {
             color: green; font-weight: bold;
         }

        .error 
        {
             color: red; font-weight: bold;
        }


        table
        {
             width: 100%; border-collapse: collapse; margin-top: 20px; 
            
        }

        th, td 
        {
             border: 1px solid black; padding: 8px; text-align: left; 
        }
        th 
        {

              background-color: #7B61FF;
        }

        .actions button 
        {
             margin-right: 5px; padding: 5px 10px; cursor: pointer; 
        }
        .approve 
        { 
            background-color:green; color: white; border: none; 
        }
        .reject 
        { 
            background-color: red; color: white; border: none; 
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

        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }

        
    </style>
</head>
<body>
    <?php include("burger.php");  ?>

 <div class="head"> <h1>Approve Pending Users</h1></div>
 <div class="container">
     

    <?php if (!empty($message)): ?>
        <p class="<?php echo (strpos($message, 'Error') !== false) ? 'error' : 'message'; ?>"><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if (empty($pendingUsers)): ?>
        <p>No user is waiting for approval.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Unit</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendingUsers as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                    <td><?php echo htmlspecialchars($user['unit']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td class="actions">
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="action" value="approve" class="approve">Approve</button>
                        </form>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="action" value="reject" class="reject">Reject</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div id="button-back"> <a href="admin.php" class="edit-button">Back</a></div>
  

 </div>
</body>
</html>