<?php
require_once "pdo.php";
session_start();
if(isset($_POST['un']) && isset($_POST['ps'])){
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
                header('Location: login.php');
                return;
            }
        }
    }
    $_SESSION['error']="Wrong Username...";
    header('Location: login.php');
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
        #newUser{
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <h2>Please enter your credentials</h2>
    <?php
    if(isset($_SESSION['error'])){
        echo '<p style="color: red">'.$_SESSION['error'].'</p>';
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['success'])){
        echo '<p style="color: green">'.$_SESSION['success'].'</p>';
        unset($_SESSION['success']);
    }
    ?>
    <form action="" method="post">
        <p>Username: <input type="text" name="un"></p>
        <p>Password: <input type="password" name="ps"></p>
        <p><input type="submit">&nbsp;<button><a id="newUser" href="newUser.php">New User</a></button></p>
    </form>
</body>
</html>