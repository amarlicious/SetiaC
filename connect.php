<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "student_setiac";


$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connect failed: " .$conn->connect_error);
}
    
?>