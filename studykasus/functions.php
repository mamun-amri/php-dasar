<?php
// koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'phpdasar');
// mysqli_fetch_row mengembalikan array numeric
// mysqli_fetch_assoc mengembalikan arrat associative
// mysqli_fetch_array mengembalikan keduanya
// mysqli_fetch_object mengembalikan dalam bentuk object
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    $nama    = htmlspecialchars($data['nama']);
    $nrp     = htmlspecialchars($data['nrp']);
    $email   = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambar  = upload();

    if (!$gambar) {
        return false;
    }

    $query = mysqli_query($conn, "INSERT INTO mahasiswa VALUES 
    (NULL,'$nama','$nrp','$email','$jurusan','$gambar')");
    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile   = $_FILES['gambar']['name'];
    $tmpFile    = $_FILES['gambar']['tmp_name'];
    $errorFile  = $_FILES['gambar']['error'];
    $sizeFile   = $_FILES['gambar']['size'];

    if ($errorFile == 4) {
        echo "
        <script>
        alert('anda belum memilih gambar!');
        </script>
        ";
        return false;
    }

    $ektensi    = strtolower(end(explode('.', $namaFile)));
    $ektensiValid   = ['jpg', 'jpeg', 'png'];
    if (!in_array($ektensi, $ektensiValid)) {
        echo "
        <script>
        alert('file ini bukan gambar!');
        </script>
        ";
        return false;
    }

    if ($sizeFile > 1000000) {
        echo "
        <script>
        alert('ukuran gambar maksimum 1MB!');
        </script>
        ";
        return false;
    }
    $namaBaru = uniqid();
    move_uploaded_file($tmpFile, "img/$namaBaru." . $ektensi);
    return $namaBaru . '.' . $ektensi;
}

function edit($data)
{
    global $conn;
    $id      = $data['id'];
    $nama    = htmlspecialchars($data['nama']);
    $nrp     = htmlspecialchars($data['nrp']);
    $email   = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    if (!$_FILES['gambar']['error'] == 4) {
        $gambarLama  = htmlspecialchars($data['gambar']);
        if (file_exists('img/' . $gambarLama)) {
            unlink('img/' . $gambarLama);
        }
        $gambar = upload();
    } else {
        $gambar  = htmlspecialchars($data['gambar']);
    }

    $query = mysqli_query($conn, "UPDATE mahasiswa SET
        `id`        = '$id',
        `nama`      = '$nama',
        `nrp`       = '$nrp',
        `email`     = '$email',
        `jurusan`   = '$jurusan',
        `gambar`    = '$gambar'
        WHERE id='$id'
        ");
    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    $query = mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    global $conn;
    $query = "SELECT * FROM mahasiswa WHERE 
    nama LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%' OR 
    nrp LIKE '%$keyword%'";

    return query($query);
}
