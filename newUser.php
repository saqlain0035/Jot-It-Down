<?php
require_once "pdo.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
</head>
<body>
    <h2>Please enter the given details</h2>
    <form action="" method="post">
        <p>Username: <input type="text" name="un"></p>
        <p>First name: <input type="text" name="fn"></p>
        <p>Last name: <input type="text" name="ln"></p>
        <p>Password: <input type="password" name="ps1"></p>
        <p>Password again: <input type="password" name="ps2"></p>
        <p>Email: <input type="email"></p>
        <p><input type="submit"></p>
    </form>
</body>
</html>