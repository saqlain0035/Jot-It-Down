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
          
        }
        body{
            background: url(background1.jpg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
.card {
position: relative;
line-height: 24px;
width: 400px;
height: auto;
padding-bottom: 20px;

border-radius: 5px;
background: rgb(0,0,0,0.75);
color: white;
backdrop-filter: blur(2px);
margin: 20px;
box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
transition: all 0.3s ease-in-out;
}

.timedel{

    padding: 10px;
}

.cardlink{
    background: rgb(66, 184, 172,0.75);
    text-decoration: none;
    color: white;
    border-radius: 10px;
    width: 100%;
    transition: all 0.2s ease-in-out;
    display: inline-block;
    padding: 10px 0;
}

.cardlink:hover{
    background: rgb(66, 184, 172,0.9);
}

.card:hover{
transform: scale(1.05);
box-shadow: rgb(33, 33, 33) 0px 20px 30px -10px;
}


.card img {
width: 100%;
height: auto;
border-top-left-radius: 5px;
border-top-right-radius: 5px;
}

.card .card-text {
padding: 10px;
text-align: center;
}

.card-text h3{
margin: 10px 0;
}
.btn{
    width: 20px;
    height: 20px;
    
}

.cardcont {
padding: 40px 100px;
align-items: center;
justify-content: center;
display: flex; 
flex-wrap: wrap;
gap: 20px;
}
.side a{
text-decoration:none;
}
.btngroup{
    display: flex;
    align-items: center;
}
.side{
margin-left: 1200px;
}
.logo{
    width: 80px;
}

    </style>
</head>
<body>
    <h2><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; unset($_SESSION['message']); }?></h2>
    <div class="btngroup">
        <img class="logo" src="logo1-removebg-preview.png" alt="">
        <div class="group">
        <button><a class="btn" href="addNote.php">Add New Note</a></button>&nbsp;
    <button><a class="btn" href="logout.php">Logout</a></button>
        </div>
    

    </div>
    
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
            echo '<a class="btn" href="delete.php?userid='.$row['id'].'"><img src="delete.png" alt="D"></a></p>';
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