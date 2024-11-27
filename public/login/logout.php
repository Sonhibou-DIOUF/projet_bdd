<?php
session_start();
if($_SESSION){
    header(tim);
}
unset($_SESSION['$connect']);
header('location: ../login.php');
?>