<?php
$servername = "localhost:3301";
$username = "root";
$password = "1234";
$dbname = "setia";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connect failed: " .$conn->connect_error);
}
    // echo "Connected succesfully";
?>