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
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-67KYJSWRRQ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-67KYJSWRRQ');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing Notes</title>
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
    <h2>Edit Note</h2>
    <form action="" method="post">
        <p>Title: <input type="text" name="title" size="40" value="<?= $tit ?>"></p>
        <p>Content: <br>
        <textarea name="content" id="" cols="60" rows="10"><?php echo $con; ?></textarea></p>
        <p><input type="submit">&nbsp;<button><a class="btn" href="home.php">Cancel</a></button></p>
    </form>
</body>
</html>
