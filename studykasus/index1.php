<?php
session_start();
require 'functions.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $_SESSION['login'] = true;
}

if (!isset($_SESSION['login'])) {
    header('Location:login.php');
    exit;
}

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
// pagination config
$perPage        = 2;
$jumlahData     = count(query("SELECT * FROM mahasiswa"));
$pageAktif      = (isset($_GET['page'])) ? $_GET['page'] : 1;
$start          = ($perPage * $pageAktif) - $pageAktif;
$jumlahHalaman  = ceil($jumlahData / $perPage);

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $start,$perPage");

// $mahasiswa = query("SELECT * FROM mahasiswa ");
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
    <style>
        #page {
            font-weight: bold;
            color: red;
        }
    </style>
</head>

<body>
    <p><a href="logout.php">logout</a></p>
    <h1>Data Mahasiswa</h1>
    <p>
        <a href="f_mahasiswa.php?aksi=tambah">Tambah Mahasiswa</a>
    </p>
    <form action='' method='post'>
        <input type="text" name="keyword" id="keyword" autocomplete="off" autofocus size="40" placeholder="cari data disini!">
        <button type="submit" name="cari" id="btn-cari">cari!</button>
    </form>
    <br>
    <?php if ($pageAktif > 1) : ?>
        <a href="?page=<?= $pageAktif - 1 ?>">&laquo;</a>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if ($i == $pageAktif) : ?>
            <a href="?page=<?= $i; ?>" id="page"><?= $i; ?></a>
        <?php else : ?>
            <a href="?page=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if ($pageAktif < $jumlahHalaman) : ?>
        <a href="?page=<?= $pageAktif + 1 ?>">&raquo;</a>
    <?php endif; ?>

    <div id="container">
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
            <?php $i = ($pageAktif != 1) ? $pageAktif + 1 : 1 ?>
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
    </div>

    <script src="js/script.js"></script>
</body>

</html>