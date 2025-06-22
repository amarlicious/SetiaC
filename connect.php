<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "student_setiac";


$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connect failed: " .$conn->connect_error);
}
    // echo "Connected succesfully";
?>