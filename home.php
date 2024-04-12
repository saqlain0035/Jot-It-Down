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
            /* background-position: center; */
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
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
.btnn{
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
.btn {
        text-decoration: none;
        color: white;
        background-color: rgb(66, 184, 172, 0.75);
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        margin-right: 10px;
        transition: all 0.2s ease-in-out;
    }
.btn a{
    text-decoration: none;
    color: white;
}
    .btn:hover {
        background-color: rgb(66, 184, 172, 0.9);
    }

    .logout-btn {
        background-color: #ff4136; /* Change color to red */
    }
    .logout-btn:hover{
        background-color: red;
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
h2{
    margin-left: 250px;
}
/* CSS for mobile devices */
@media screen and (max-width: 768px) {
    .btngroup {
        flex-direction: column;
        align-items: center;
    }

    .side {
        margin-left: 0;
        margin-top: 10px;
    }

    .cardcont {
        padding: 20px;
    }

    .card {
        width: 90%;
        margin: 0 auto 20px;
    }

    h2 {
        margin-left: 0;
        text-align: center;
    }
}

    </style>
</head>
<body>
    <div class="btngroup">
    <img class="logo" src="logo1-removebg-preview.png" alt="">
    <div class="group">
        <button class="btn"><a href="addNote.php">Add New Note</a></button>
        <button class="btn logout-btn"><a href="logout.php">Logout</a></button>
    </div>
    <h2><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; unset($_SESSION['message']); }?></h2>
</div>

    

    </div>

    <?php
    if(isset($_SESSION['message2'])){
        echo '<p style="color: green;">'.$_SESSION['message2'].'</p>';
        unset($_SESSION['message2']);
    }
    $un=$_SESSION['username'];
    $sql="select * from $un order by timing desc";
    $stmt=$pdo->query($sql);
    ?>
    <div class="cardcont">
        
        <?php
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<div class="card">';
            $datetime=new DateTime($row['timing']);
            $formated=$datetime->format('d M Y, D h:i a');
            echo '<p class="timedel">'.$formated;
            echo '<a class="btnn" href="delete.php?userid='.$row['id'].'"><img src="delete.png" alt="D"></a></p>';
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