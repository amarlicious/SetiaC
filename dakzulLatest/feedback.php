<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "Access denied. Please log in.";
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Feedback</title>
    <link rel="stylesheet" href="../css/report.css" type="text/css" />
    <style>
        .error-message {
            color: #d9534f;
            background-color: #f9d6d5;
            border: 1px solid #d9534f;
            border-radius: 6px;
            padding: 10px 15px;
            margin: 15px auto;
            width: fit-content;
            text-align: center;
            font-weight: bold;
            display: none;
        }
        .report-box {
            background-color: #ffffff;
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px grey;
        }
    </style>
</head>
<body>
<?php include("../adminfile/burger.php"); ?>

<div class="head">
    <h1>Feedback</h1>
</div>

<div class="report-box">
    <form id="form1" action="feedbacksubmit.php" method="POST">
        <h2 class="addReport">Leave Your Feedback</h2>
        <input type="text" name="feedback_text" id="feedback_text" placeholder="Enter your message..." class="report-input" />
        
        <div id="validationMessage" class="error-message"></div>
        
        <button type="submit" class="send-button" name="submit">Send</button>
    </form>
</div>

<script>
    const form = document.getElementById('form1');
    const feedbackTextInput = document.getElementById('feedback_text');
    const validationMessage = document.getElementById('validationMessage');

    form.addEventListener('submit', function(event) {
        if (feedbackTextInput.value.trim() === '') {
            event.preventDefault();
            validationMessage.innerHTML = 'Please enter your message.';
            validationMessage.style.display = 'block';
        } else {
            validationMessage.style.display = 'none';
        }
    });

    feedbackTextInput.addEventListener('input', function() {
        validationMessage.style.display = 'none';
    });
</script>
</body>
</html>
