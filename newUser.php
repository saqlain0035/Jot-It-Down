<?php
require_once "pdo.php";
session_start();
if(isset($_POST['submit']) && isset($_POST['un']) && isset($_POST['fn']) && isset($_POST['ps1']) && isset($_POST['ps2']) && isset($_POST['em'])){
    $_SESSION['username']=$_POST['un'];
    $_SESSION['firstname']=$_POST['fn'];
    $_SESSION['lastname']=$_POST['ln'];
    $_SESSION['email']=$_POST['em'];
    if($_POST['un']==''){
        $_SESSION['error']="Please enter Username...";
        header('Location: newUser.php');
        return;
    }
    if($_POST['fn']==''){
        $_SESSION['error']="Please enter First Name...";
        header('Location: newUser.php');
        return;
    }
    if($_POST['ps1']==''){
        $_SESSION['error']="Please enter Password...";
        header('Location: newUser.php');
        return;
    }
    if($_POST['em']==''){
        $_SESSION['error']="Please enter Email...";
        header('Location: newUser.php');
        return;
    }
    if($_POST['ps1'] !== $_POST['ps2']){
        $_SESSION['error']="Your password doesn't match...";
        header('Location: newUser.php');
        return;
    }
    $stm=$pdo->query('select userid,email from users');
    while($row=$stm->fetch(PDO::FETCH_ASSOC)){
        if($_POST['un']==$row['userid']){
            $_SESSION['error']="Username already exist...";
            header('Location: newUser.php');
            return;
        }
        if($_POST['em']==$row['email']){
            $_SESSION['error']="Email already exist...";
            header('Location: newUser.php');
            return;
        }
    }
    $stmt=$pdo->prepare('insert into users values (?,?,?,?,?)');
    $stmt->execute(array($_POST['un'],$_POST['fn'],$_POST['ln'],$_POST['ps1'],$_POST['em']));
    $_SESSION['success']="User registered sucessfully, now login...";
    $u=$_POST['un'];
    $sql="create table $u (id int auto_increment key, timing datetime, title varchar(128), content text)";
    $pdo->query($sql);
    unset($_SESSION['username']);
    unset($_SESSION['firstname']);
    unset($_SESSION['lastname']);
    unset($_SESSION['email']);
    header('Location: index.php');
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin-top: 10px;
            padding: 0;
            margin-left: 30%;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            height: 100vh;
            margin-top: 10px;
        }

        h2 {
            color: #333;
            font-size: 20px;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border-radius: 15px;
            border: 1px solid #ccc;
            font-size: 14px;
            font-family: 'Times New Roman', Times, serif;
            margin-bottom: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            text-align: left;
        }
        .login-header {
    text-align: center;
    margin-bottom: 0;
    display: inline-flex;
}

.login-header img {
    width: 90px;
    border-radius: 50%;
    border: 2px solid #fff;
}

.login-header h2 {
    margin-top: 10%;
    font-size: 22px;
    letter-spacing: 2px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}
    </style>
</head>
<body>
    <div class="container">
    <div class="login-header">
            <img src="logo1-removebg-preview.png" alt="Logo" width="90px">
            <h2>Enter the Given Details</h2>
        </div>
    <?php
    if(isset($_SESSION['error'])){
        echo '<p style="color:red";>'.$_SESSION['error'].'</p>';
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['username'])){
        $un=$_SESSION['username'];
        unset($_SESSION['username']);
    }
    else{
        $un='';
    }
    if(isset($_SESSION['firstname'])){
        $f=$_SESSION['firstname'];
        unset($_SESSION['firstname']);
    }
    else{
        $f='';
    }
    if(isset($_SESSION['lastname'])){
        $l=$_SESSION['lastname'];
        unset($_SESSION['lastname']);
    }
    else{
        $l='';
    }
    if(isset($_SESSION['email'])){
        $e=$_SESSION['email'];
        unset($_SESSION['email']);
    }
    else{
        $e='';
    }
    ?>
    <form action="" method="post">
        <p>Username: <input type="text" name="un" value="<?= $un ?>"></p>
        <p>First name: <input type="text" name="fn" value="<?= $f ?>"></p>
        <p>Last name: <input type="text" name="ln" value="<?= $l ?>"></p>
        <p>Password: <input type="password" name="ps1"></p>
        <p>Password again: <input type="password" name="ps2"></p>
        <p>Email: <input type="email" name="em" value="<?= $e ?>"></p>
        <p><input type="submit" name="submit"></p>
    </form>
    </div>
</body>
</html>