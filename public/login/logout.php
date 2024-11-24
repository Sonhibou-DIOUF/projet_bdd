<?php
session_start();
unset($_SESSION['$connect']);
header('location: ../login/login.php');
?>