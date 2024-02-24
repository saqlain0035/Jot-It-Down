<?php
require_once "pdo.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>
<body>
    <form action="" method="post">
        <label for="">Title:</label><br>
        <input type="text" name="title"><br><br>
        <label for="">Content:</label><br>
        <textarea name="content" id="" cols="200" rows="400"></textarea>
        <input type="submit">
    </form>
</body>
</html>