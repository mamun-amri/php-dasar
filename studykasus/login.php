<?php
session_start();
require 'functions.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {

    $result = mysqli_query($conn, "SELECT username FROM user");
    $row    = mysqli_fetch_assoc($result);

    if ($_COOKIE['key'] === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION['login'])) {
    header('Location:index.php');
    exit;
}

if (isset($_POST['login'])) {
    if (login($_POST) > 0) {
        $result = mysqli_query($conn, "SELECT * FROM user WHERE username ='$_POST[username]'");
        $row = mysqli_fetch_assoc($result);
        // set session 
        $_SESSION['login'] = true;
        // set cookie
        if (isset($_POST['remember'])) {
            setcookie('id', $row['id'], time() + 60);
            setcookie('key', hash('sha256', '$row[username]'), time() + 60);
        }

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
                <input type='checkbox' name='remember' id='remember'>
                <label for='remember'>Remember me</label>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
</body>

</html>