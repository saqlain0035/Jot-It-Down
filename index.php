<?php
require_once "pdo.php";
session_start();
if(isset($_SESSION['username'])){
    header('Location: home.php');
    return;
}
if(isset($_POST['submit']) && isset($_POST['un']) && isset($_POST['ps'])){
    if($_POST['un']==''){
        $_SESSION['error']="Please enter Username...";
        header('Location: index.php');
        return;
    }
    if($_POST['ps']==''){
        $_SESSION['error']="Please enter Password...";
        $_SESSION['unfield']=$_POST['un'];
        header('Location: index.php');
        return;
    }
    $stmt=$pdo->query('select userid,password,firstname from users');
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        if($row['userid']==$_POST['un']){
            if($row['password']==$_POST['ps']){
                $_SESSION['message']="Welcome, ".$row['firstname'];
                $_SESSION['username']=$_POST['un'];
                header('Location: home.php');
                return;
            }
            else{
                $_SESSION['error']="Wrong Password...";
                $_SESSION['unfield']=$_POST['un'];
                header('Location: index.php');
                return;
            }
        }
    }
    $_SESSION['error']="Wrong Username...";
    header('Location: index.php');
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Body style with background image */
    body {
    background-image: linear-gradient(to right bottom, rgba(255, 0, 0, 0.5), rgba(255, 255, 0, 0.5)), url('background1.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #fff;
}

/* Style for login container */
.login-container {
    width: 320px;
    margin: 100px auto;
    padding: 40px;
    border-radius: 10px;
    backdrop-filter: blur(3px);
    background-color: rgba(0, 0, 0, 0.5);
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s ease-in-out;
}

.login-container:hover {
    transform: translateY(-5px);
}

/* Style for login header */
.login-header {
    text-align: center;
    margin-bottom: 20px;
}

.login-header img {
    width: 90px;
    border-radius: 50%;
    border: 2px solid #fff;
}

.login-header h2 {
    margin-top: 0;
    font-size: 32px;
    letter-spacing: 2px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

/* Style for error and success messages */
.login-container p {
    margin: 0;
}

.login-container p.error {
    color: #ff6666;
}

.login-container p.success {
    color: #66ff66;
}

/* Style for form elements */
.login-container form {
    margin-top: 20px;
}

.login-container form p {
    margin-bottom: 15px;
}

.login-container form input[type="text"],
.login-container form input[type="password"] {
    width: calc(100% - 20px);
    padding: 12px;
    border: none;
    border-radius: 25px;
    background-color: rgba(255, 255, 255, 0.7);
    transition: background-color 0.3s ease-in-out;
}

.login-container form input[type="text"]:focus,
.login-container form input[type="password"]:focus {
    background-color: rgba(255, 255, 255, 0.9);
}

.login-container form input[type="submit"],
.login-container form button {
    padding: 12px 20px;
    background-color: #4CAF50;
    border: none;
    color: #fff;
    border-radius: 25px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease-in-out;
}

.login-container form button:hover {
    background-color: #45a049;
}

.login-container form button a {
    color: #fff;
    text-decoration: none;
}

    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="logo1-removebg-preview.png" alt="Logo" width="90px">
            <h2>JotItDown</h2>
        </div>
    <?php
    if(isset($_SESSION['error'])){
        echo '<p style="color: red">'.$_SESSION['error'].'</p>';
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['success'])){
        echo '<p style="color: green">'.$_SESSION['success'].'</p>';
        unset($_SESSION['success']);
    }
    if(isset($_SESSION['unfield'])){
        $un=$_SESSION['unfield'];
        unset($_SESSION['unfield']);
    }
    else{
        $un='';
    }
    ?>

    <form action="" method="post">
        <p>Username: <input type="text" name="un" value="<?= $un ?>"></p>
        <p>Password: <input type="password" name="ps"></p>
        <p><input type="submit" name="submit">&nbsp;<button><a id="newUser" href="newUser.php">New User</a></button></p>
    </form>
    </div>
</body>
</html>