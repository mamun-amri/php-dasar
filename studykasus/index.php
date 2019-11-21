<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location:login.php');
    exit;
}

require 'functions.php';
if (isset($_REQUEST['aksi']) == 'hapus') {
    $id = $_REQUEST['id'];
    if (hapus($id) > 0) {
        echo "
        <script> 
            alert('data berhasil dihapus!');
            document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script> 
            alert('data gagal dihapus!');
            document.location.href = 'index.php';
        </script>
        ";
    }
}

$mahasiswa = query("SELECT * FROM mahasiswa");
if (isset($_POST['cari'])) {
    $mahasiswa = cari($_POST['keyword']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latihan</title>
</head>

<body>
    <p><a href="logout.php">logout</a></p>
    <h1>Data Mahasiswa</h1>
    <p>
        <a href="f_mahasiswa.php?aksi=tambah">Tambah Mahasiswa</a>
    </p>
    <form action='' method='post'>
        <input type="text" name="keyword" autocomplete="off" autofocus size="40" placeholder="cari data disini!">
        <button type="submit" name="cari">cari!</button>
    </form>
    <br>
    <table border="1" cellpadding="10" callpadding="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>NRP</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($mahasiswa as $mhs) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td>
                    <a href="f_mahasiswa.php?aksi=edit&id=<?= $mhs['id']; ?>">ubah</a> |
                    <a href="index.php?aksi=hapus&id=<?= $mhs['id']; ?>" onclick="return confirm('anda yakin!');">hapus</a>
                </td>
                <td><img src="img/<?= $mhs['gambar']; ?>" width="50"></td>
                <td><?= $mhs['nama']; ?></td>
                <td><?= $mhs['nrp']; ?></td>
                <td><?= $mhs['email']; ?></td>
                <td><?= $mhs['jurusan']; ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>