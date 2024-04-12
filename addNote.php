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
    $_SESSION['message2']="Note inserted successfully...";
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
        /* Import styles from the home page */
        .btn{
            text-decoration: none;
            color: black;
        }
        body{
            background: url(background1.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        h2{
            color: white;
            background: rgb(0,0,0,0.75);
            backdrop-filter: blur(3px);
            padding: 10px;
            width: 33%;
            text-align: center;
            border-radius: 10px;
        }
        p{
            color: white;
        }
        textarea, input[type="text"], input[type="submit"]{
            background: rgb(0,0,0,0.75);
            border: none;
            border-radius: 5px;
            color: white;
            padding: 5px;
            margin: 5px;
        }
        input[type="submit"], button{
            padding: 10px 20px;
            background: rgb(66, 184, 172,0.75);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }
        input[type="submit"]:hover, button:hover{
            background: rgb(66, 184, 172,0.9);
        }
        a.btn{
            color: white;
        }
        a.btn:hover{
            color: black;
        }
        /* CSS for mobile devices */
@media screen and (max-width: 768px) {
    body {
        padding: 20px;
    }

    h2, p {
        text-align: center;
    }

    input[type="text"],
    textarea,
    input[type="submit"],
    button {
        width: 90%;
        margin: 10px auto;
    }

    textarea {
        resize: vertical; /* Allow vertical resizing */
    }
}

    </style>
</head>
<body>
    <h2>Add new Note</h2>
    <?php
    if(isset($_SESSION['error'])){
        echo '<p>'.$_SESSION['error'].'</p>';
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
