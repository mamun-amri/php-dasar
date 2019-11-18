<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['username']) == 'admin' & $_POST['password'] == '123') {
        header('Location:admin.php');
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
</head>

<body>
    <h1>Login User</h1>
    <?php
    if (isset($error)) { ?>
        <p>anda memasukan username atau password yang salah!</p>
    <?php
    }
    ?>
    <ul>
        <form action="" method="post">
            <li>
                <label for='username'>username</label>
                <input type='text' name='username' id='username'>
            </li>
            <li>
                <label for='password'>password</label>
                <input type='password' name='password' id='password'>
            </li>
            <li>
                <button type="submit" name="submit">Kirim!</button>
            </li>
        </form>
    </ul>
</body>

</html>