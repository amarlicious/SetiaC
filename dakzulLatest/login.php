<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
.message{
  color: red;
  background-color: #f9d6d5;
  padding: 12px 20px;
  margin: 20px auto;
  width: fit-content;
  border: 1px solid #d9534f;
  border-radius: 6px;
  font-weight: bold;
  font-family: 'Segoe UI', sans-serif;
}
</style>
<body>
</body>
</html>
<?php
session_start();
include('connect.php');

if(!isset($_SESSION['username'])&& $_SERVER['REQUEST_METHOD'] == 'POST'){
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
}

if(isset($_SESSION['username'], $_SESSION['password'])){
    $username = $_SESSION['username'];
    $input_password = $_SESSION['password'];

    $sql = "SELECT * FROM residence WHERE username='$username'";
    $result = $conn->query(query: $sql);

    if($result->num_rows == 1){
        $user = $result->fetch_assoc();

        if(password_verify($input_password, $user['password'])){
            include("main.php");
        }   else{
            echo "<div class= 'message'>Login Fail: Wrong password</div>";
            session_unset();
            echo "<meta http-equiv='refresh' content='3;URL=index.php'>";
        }
    }else{
        echo "<div class= 'message'>Login Fail: Username doesn't exist</div>";
        session_unset();
        echo "<meta http-equiv='refresh' content='3;URL=index.php'>";
    }
}
$conn->close();

?>