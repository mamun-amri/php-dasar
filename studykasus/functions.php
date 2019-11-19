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
    $gambar  = htmlspecialchars($data['gambar']);

    $query = mysqli_query($conn, "INSERT INTO mahasiswa VALUES 
    (NULL,'$nama','$nrp','$email','$jurusan','$gambar')");
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;
    $id      = $data['id'];
    $nama    = htmlspecialchars($data['nama']);
    $nrp     = htmlspecialchars($data['nrp']);
    $email   = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambar  = htmlspecialchars($data['gambar']);

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
