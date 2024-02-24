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
        
    </style>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <h2><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; unset($_SESSION['message']); }?></h2>
    <button><a class="btn" href="addNote.php">Add New Note</a></button>&nbsp;
    <button><a class="btn" href="logout.php">Logout</a></button>
    <?php
    $un=$_SESSION['username'];
    $sql="select * from $un";
    $stmt=$pdo->query($sql);
    ?>
    <div class="cardcont">
        <?php
        while($stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<div class="card">';
            echo '<p>'.$row['timing'].'</p>';
            echo '<div class="card-text">';
            echo '<h3>'.$row['title'].'</h3>';
            echo '<p>'.$row['content'].'</p>';
            echo '<a class="cardlink" href="edit.php?id='.$row['id'].'">Edit</a>';
            echo '</div></div>';
        }
        ?>
    </div>
</body>
</html>