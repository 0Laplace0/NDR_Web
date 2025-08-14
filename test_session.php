<?php 
// Start using session
session_start();

// Create session variable
$_SESSION['userID'] = 1;
$_SESSION['userName'] = 'Kritpanit';
$_SESSION['status'] = 'active';

// show all session variable
echo '<pre>';
print_r($_SESSION);

// ใช้จริง
echo $_SESSION['userID'];
echo '<br>';
echo $_SESSION['userName'];
echo '<br>';
echo $_SESSION['status'];
?>