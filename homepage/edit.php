<?php
session_start();
include('../dakzulLatest/connect.php'); // Adjust path as needed

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];
$message = ''; // To store success or error messages

// Fetch current user data
$sql = "SELECT * FROM residence WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    $message = "<div class='message'>User not found.</div>";
    // Optionally redirect or handle this error more gracefully
    exit();
}

// Handle form submission for updating profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);

    // Update data in the database
    $update_sql = "UPDATE residence SET name = ?, email = ?, phone = ? WHERE username = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssss", $fullname, $email, $phone, $username);

    if ($stmt->execute()) {
        $message = "<div class='success-message'>Profile updated successfully!</div>";
        // Update the $user array so the form displays the new data immediately
        $user['name'] = $fullname;
        $user['email'] = $email;
        $user['phone'] = $phone;
    } else {
        $message = "<div class='error-message'>Error updating profile: " . $conn->error . "</div>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f7;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #7B61FF;
            color: white;
            padding: 1px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 20px;
            font-family: Arial, sans-serif;
        }
        #text {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            display: block;
            width: 100%;
        }
        .container {
            max-width: 500px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #d6ccff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .tajukpart {
            font-weight: bold;
            font-size: 27px;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box; /* Ensures padding doesn't increase total width */
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .save-button, .back-button {
            padding: 10px 25px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none; /* For the back button acting as a link */
            text-align: center;
            display: inline-block;
        }
        .save-button {
            background-color: #7B61FF;
            color: white;
        }
        .save-button:hover {
            background-color: #6a4fe3;
        }
        .back-button {
            background-color: #ccc;
            color: #333;
        }
        .back-button:hover {
            background-color: #bbb;
        }
        .message {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<div class="header">
    <h1 id="text">Edit Profile</h1>
</div>

<div class="container">
    <div class="tajukpart">Update Your Information</div>

    <?php if ($message): ?>
        <?= $message ?>
    <?php endif; ?>

    <form action="edit.php" method="POST">
        <div class="form-group">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div class="form-group">
            <label for="phone">Contact:</label>
            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
        </div>

        <div class="buttons">
            <button type="submit" class="save-button">Save Changes</button>
            <a href="profile.php" class="back-button">Back to Profile</a>
        </div>
    </form>
</div>

</body>
</html>