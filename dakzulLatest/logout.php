<?php
session_start();

// Kosongkan sesi tanpa semakan
session_unset();
session_destroy();

// Papar mesej dan redirect
echo "<div class='message'>You have been logged out. Redirecting to homepage...</div>";
echo "<meta http-equiv='refresh' content='3;URL=../homepage/homebaru.php'>";
?>
