<?php
require_once "pdo.php";
session_start();
if(isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['content'])){
    if($_POST['title']==''){
        $_SESSION['cont']=$_POST['content'];
        $_SESSION['error']="Please enter Title...";
        header('Location: addNote.php');
        return;
    }
    if($_POST['content']==''){
        $_SESSION['titl']=$_POST['title'];
        $_SESSION['error']="Please enter Content...";
        header('Location: addNote.php');
        return;
    }
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
    <?php
    if(isset($_SESSION['error'])){
        echo '<p style="color:red";>'.$_SESSION['error'].'</p>';
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['titl'])){
        $t=$_SESSION['titl'];
        unset($_SESSION['titl']);
    }
    else{
        $t='';
    }
    if(isset($_SESSION['cont'])){
        $c=$_SESSION['cont'];
        unset($_SESSION['cont']);
    }
    else{
        $c='';
    }
    ?>
    <form action="" method="post">
        <p>Title: <input type="text" name="title" size="40" value="<?= $t ?>"></p>
        <p>Content: <br>
        <textarea name="content" id="" cols="60" rows="10"><?= $c ?></textarea></p>
        <p><input type="submit" name="submit">&nbsp;<button><a class="btn" href="home.php">Cancel</a></button></p>
    </form>
</body>
</html>