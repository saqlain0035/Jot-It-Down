<?php
require_once "pdo.php";
session_start();
$un=$_SESSION['username'];

if(isset($_POST['title']) && isset($_POST['content'])){
    $sql="update $un set title=:t, content=:c where id=:i";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
        ':t'=>$_POST['title'],
        ':c'=>$_POST['content'],
        ':i'=>$_GET['userid']
    ));
    $_SESSION['message2']="Note updated successfully...";
    header('Location: home.php');
    return;
}
$sql="select * from $un where id=?";
$stmt=$pdo->prepare($sql);
$stmt->execute(array($_GET['userid']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$tit=$row['title'];
$con=$row['content'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing Notes</title>
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
        <p>Title: <input type="text" name="title" size="40" value="<?= $tit ?>"></p>
        <p>Content: <br>
        <textarea name="content" id="" cols="60" rows="10"><?php echo $con; ?></textarea></p>
        <p><input type="submit">&nbsp;<button><a class="btn" href="home.php">Cancel</a></button></p>
    </form>
</body>
</html>