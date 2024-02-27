<?php
require_once "pdo.php";
session_start();
if(isset($_POST['title']) && isset($_POST['content'])){
    $u=$_SESSION['username'];
    $sql="insert into $u (timing,title,content) values (now(),?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($_POST['title'],$_POST['content']));
    $_SESSION['message2']="Note inserted sucessfully...";
    header('Location: home.php');
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adding Notes</title>
    <style>
        .btn{
            text-decoration: none;
            color: black;
        }
        
    </style>
</head>
<body>
    <h2>Add new Note</h2>
    <form action="" method="post">
        <p>Title: <input type="text" name="title" size="40"></p>
        <p>Content: <br>
        <textarea name="content" id="" cols="60" rows="10"></textarea></p>
        <p><input type="submit">&nbsp;<button><a class="btn" href="home.php">Cancel</a></button></p>
    </form>
</body>
</html>