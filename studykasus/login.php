<?php
session_start();

if (isset($_SESSION['login'])) {
    header('Location:index.php');
    exit;
}

require 'functions.php';
if (isset($_POST['login'])) {
    if (login($_POST) > 0) {
        $_SESSION['login'] = true;
        header('Location:index.php');
        exit;
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>
</head>

<body>
    <h1>Halaman Login</h1>
    <?php if (isset($error)) : ?>
        <p>username atau password salah!</p>
    <?php endif; ?>

    <form action='' method='post'>
        <ul>
            <li>
                <label for='username'>Username</label>
                <input type='text' name='username' id='username'>
            </li>
            <li>
                <label for='password'>Password</label>
                <input type='password' name='password' id='password'>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
</body>

</html>