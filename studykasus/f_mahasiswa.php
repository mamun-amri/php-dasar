<?php
require 'functions.php';
if (isset($_POST['submit'])) {
    if ($_REQUEST['aksi'] == 'tambah') {
        if (tambah($_POST) > 0) {
            echo "
            <script> 
                alert('data berhasil disimpan!');
                document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script> 
                alert('data gagal disimpan!');
                document.location.href = 'index.php';
            </script>
            ";
        }
    } else {
        if (edit($_POST) > 0) {
            echo "
            <script> 
                alert('data berhasil diedit!');
                document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script> 
                alert('data gagal diedit!');
                document.location.href = 'index.php';
            </script>
            ";
        }
    }
}

if ($_REQUEST['aksi'] == 'edit') {
    $id         = $_REQUEST['id'];
    $mhs        = query("SELECT * FROM mahasiswa WHERE id=$id")[0];
    $nrp        = $mhs['nrp'];
    $nama       = $mhs['nama'];
    $email      = $mhs['email'];
    $jurusan    = $mhs['jurusan'];
    $gambar     = $mhs['gambar'];
    $aksi       = 'edit';
} else {
    $id         = "";
    $nrp        = "";
    $nama       = "";
    $email      = "";
    $jurusan    = "";
    $gambar     = "";
    $aksi       = 'tambah';
}
?>

<h1>Tambah Data Mahasiswa</h1>
<ul>
    <form action='f_mahasiswa.php?aksi=<?= $aksi ?>' method='post'>
        <li>
            <label for='nrp'>nrp</label>
            <input type='text' name='nrp' id='nrp' value="<?= $nrp ?>">
        </li>
        <li>
            <label for='nama'>nama</label>
            <input type='text' name='nama' id='nama' value="<?= $nama ?>">
        </li>
        <li>
            <label for='email'>email</label>
            <input type='text' name='email' id='email' value="<?= $email ?>">
        </li>
        <li>
            <label for='jurusan'>jurusan</label>
            <input type='text' name='jurusan' id='jurusan' value="<?= $jurusan ?>">
        </li>
        <li>
            <label for='gambar'>gambar</label>
            <input type='text' name='gambar' id='gambar' value="<?= $gambar ?>">
        </li>
        <li>
            <input type="hidden" name="id" value="<?= $id; ?>">
            <button type="submit" name="submit"><?= $aksi; ?> Data!</button>
        </li>
    </form>
</ul>