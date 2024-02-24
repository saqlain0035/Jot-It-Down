<?php
require_once "pdo.php";
session_start();
if(isset($_POST['un']) && isset($_POST['fn']) && isset($_POST['ps1']) && isset($_POST['ps2']) && isset($_POST['em'])){
    if($_POST['ps1'] !== $_POST['ps2']){
        $_SESSION['error']="Your password doesn't match...";
        header('Location: newUser.php');
        return;
    }
    $stmt=$pdo->prepare('insert into users values (?,?,?,?,?)');
    $stmt->execute(array($_POST['un'],$_POST['fn'],$_POST['ln'],$_POST['ps1'],$_POST['em']));
    $_SESSION['success']="User registered sucessfully, now login...";
    $u=$_POST['un'];
    $sql="create table $u (timing datetime, title varchar(128), content text)";
    $pdo->query($sql);
    header('Location: login.php');
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
</head>
<body>
    <h2>Please enter the given details</h2>
    <?php
    if(isset($_SESSION['error'])){
        echo '<p style="color:red";>'.$_SESSION['error'].'</p>';
        unset($_SESSION['error']);
    }
    ?>
    <form action="" method="post">
        <p>Username: <input type="text" name="un"></p>
        <p>First name: <input type="text" name="fn"></p>
        <p>Last name: <input type="text" name="ln"></p>
        <p>Password: <input type="password" name="ps1"></p>
        <p>Password again: <input type="password" name="ps2"></p>
        <p>Email: <input type="email" name="em"></p>
        <p><input type="submit"></p>
    </form>
</body>
</html>