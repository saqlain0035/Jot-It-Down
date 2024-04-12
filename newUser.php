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
        button a{
            text-decoration: none;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin-top: 10px;
            padding: 0;
            /* margin-left: 30%; */
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: linear-gradient(to right bottom, rgba(255, 0, 0, 0.5), rgba(255, 255, 0, 0.5)), url('background1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 0px 30px;
            max-width: 90vw;
            width: 400px;
            text-align: center;
            height: 100vh;
            margin-top: 10px;

            border-radius: 10px;
            backdrop-filter: blur(3px);
            background-color: rgba(0, 0, 0, 0.5);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease-in-out;
        }

        .container:hover{
            transform: translateY(-5px);
        }

        h2 {
            margin-left: 10px;
            font-size: 20px;
            margin-bottom: 10px;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
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

        button{
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

        button:hover{
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
    margin-top: 5px;
    width: 80px;
    border-radius: 50%;
    border: 2px solid #fff;
}

.login-header h2 {
    margin-top: 10%;
    font-size: 22px;
    letter-spacing: 2px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}
.button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.button-container input[type="submit"],
.button-container button {
    flex: 1;
}
/* CSS for mobile devices */
@media screen and (max-width: 480px) {
    .container {
        margin-left: auto;
        margin-right: auto;
        margin-top: 50px;
        height: auto;
        border-radius: 0;
    }

    .login-header img {
        width: 70px;
        margin-top: 0;
    }

    .login-header h2 {
        margin-top: 10px;
        font-size: 18px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
        width: calc(100% - 20px);
        margin-bottom: 15px;
    }

    .button-container {
        flex-direction: column;
    }

    .button-container input[type="submit"],
    .button-container button {
        width: 100%;
        margin-bottom: 10px;
    }
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
        <p class="button-container">
            <input type="submit" name="submit">&nbsp;&nbsp;
            <button type="button"><a href="index.php"><font color="white">Login</font></a></button>
        </p>

    </form>
    </div>
</body>
</html>