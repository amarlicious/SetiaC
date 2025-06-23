<?php
session_start();
include('connect.php'); 

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM residence WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    echo "<div class='message'>User not found.</div>";
    exit();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);


    $picture = $user['picture']; 

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $target_dir = "../uploads/";
        $file_name = basename($_FILES["picture"]["name"]);
        $target_file = $target_dir . time() . "_" . $file_name;

        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            $picture = $target_file;
        }
    }

    $update_sql = "UPDATE residence SET name = ?, email = ?, phone = ?, picture = ? WHERE username = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssss", $fullname, $email, $phone, $picture, $username);

    if ($stmt->execute()) {
        $message = "<div class='success-message'>Profile updated successfully!</div>";

    
        $user['name'] = $fullname;
        $user['email'] = $email;
        $user['phone'] = $phone;
        $user['picture'] = $picture;
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
     <link rel="stylesheet" href="css/edit.css" type="text/css">

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
<!-- information -->
    <form action="edit.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone no:</label>
            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
        </div>

        <div class="form-group" enctype="multipart/form-data">
            <label for="Picture">Picture:</label>
             <input type="file" name="picture" id="picture" >

        </div>
<!-- button -->
        <div class="buttons">
            <button type="submit" class="save-button">Save Changes</button>
            <a href="profile.php" class="back-button">Back to Profile</a>
        </div>
        
      
    </form>
</div>

</body>
</html>