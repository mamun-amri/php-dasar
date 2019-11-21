<?php
session_start();

if (isset($_SESSION['login'])) {
    header('Location:index.php');
    exit;
}

require 'functions.php';

if (isset($_POST['register'])) {
    if (register($_POST) > 0) {
        echo "
        <script>
        alert('registrasi berhasil!');
        </script>
        ";
    } else {
        echo "
        <script>
        alert('registrasi gagal!');
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Registrasi</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <h1>Halaman Registrasi</h1>
    <ul>
        <form action='' method='post'>
            <li>
                <label for='username'>username</label>
                <input type='text' name='username' id='username' autocomplete="off" autofocus>
            </li>
            <li>
                <label for='password'>password</label>
                <input type='password' name='password' id='password' autocomplete="off">
            </li>
            <li>
                <label for='password2'>password2</label>
                <input type='password' name='password2' id='password2' autocomplete="off">
            </li>
            <li>
                <button type="submit" name="register">Registrasi</button>
            </li>
        </form>
    </ul>
</body>

</html>