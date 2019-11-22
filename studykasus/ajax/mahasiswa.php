<?php
require '../functions.php';
$keyword    = $_GET['keyword'];

$query = "SELECT * FROM mahasiswa WHERE 
    nama LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%' OR 
    nrp LIKE '%$keyword%'";
$mahasiswa = query($query);
?>

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
    <?php $i = 1 ?>
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