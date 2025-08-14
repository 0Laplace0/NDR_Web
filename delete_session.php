<?php 
session_start();
print_r($_SESSION);

// ต้องการลบตัวแปร
unset($_SESSION['status']);
?>