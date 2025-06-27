<?php
session_start();
include('connect.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];

// Check if user is not admin
$sql = "SELECT * FROM residence WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    header("Location: nonfeedback.php");
    exit();
}
?>
<?php include("burger.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
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
    
        .feedback-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }

        .feedback-box {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            width: 500px;
        }

        .feedback-box textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            font-size: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
            resize: vertical;
        }

        .submit-btn {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #218838;
        }

        label {
            font-size: 18px;
        }

        .message {
            text-align: center;
            margin-top: 100px;
            font-size: 20px;
            color: red;
        }
    </style>
</head>
<body>

    <div class="head">
    <h1 id= text >Feedback</h1>
</div>

    <div class="feedback-container">
        <div class="feedback-box">
            <form action="feedbackpost.php" method="POST">
                <label for="feedback_text"><strong>Give Your Feedback about the report:</strong></label><br><br>
                <textarea name="feedback_text" id="feedback_text" required></textarea><br>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>

</body>
</html>
