<?php
session_start();
unset($_SESSION['username']);
$_SESSION['success']="Logged out sucessfully...";
header('Location: index.php');
return;
?>