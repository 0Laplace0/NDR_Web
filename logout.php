<?php 
session_start(); // ประกาศใช้ session
session_destroy(); // Clear session
header('Location: login.php'); //Logout
?>