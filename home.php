<?php
require_once "pdo.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        .btn{
            text-decoration: none;
            color: black;
        }
        .timedel{
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }
    </style>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <h2><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; unset($_SESSION['message']); }?></h2>
    <button><a class="btn" href="addNote.php">Add New Note</a></button>&nbsp;
    <button><a class="btn" href="logout.php">Logout</a></button>
    <?php
    if(isset($_SESSION['message2'])){
        echo '<p style="color: green;">'.$_SESSION['message2'].'</p>';
        unset($_SESSION['message2']);
    }
    $un=$_SESSION['username'];
    $sql="select * from $un";
    $stmt=$pdo->query($sql);
    ?>
    <div class="cardcont">
        <?php
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<div class="card">';
            echo '<p class="timedel">'.$row['timing'];
            echo '<button><a class="btn" href="delete.php?userid='.$row['id'].'">Del</a></button></p>';
            echo '<div class="card-text">';
            echo '<h3>'.$row['title'].'</h3>';
            echo '<p>'.$row['content'].'</p>';
            echo '<a class="cardlink" href="edit.php?userid='.$row['id'].'">Edit</a>';
            echo '</div></div>';
        }
        ?>
    </div>
</body>
</html>