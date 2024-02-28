<?php
require_once "pdo.php";
session_start();
$un=$_SESSION['username'];
$sql="delete from $un where id=?";
$stmt=$pdo->prepare($sql);
$stmt->execute(array($_GET['userid']));
$_SESSION['message2']="Note deleted successfully...";
header('Location: home.php');
return;
?>