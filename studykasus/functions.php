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

function register($data)
{
    global $conn;
    $username   = strtolower(stripcslashes($data['username']));
    $password   = mysqli_real_escape_string($conn, $data['password']);
    $password2  = mysqli_real_escape_string($conn, $data['password2']);

    if (empty(trim($username)) || empty(trim($password2)) || empty(trim($password))) {
        echo "
        <script>
        alert('field tidak boleh kosong!');
        </script>
        ";
        return false;
    }

    if ($password != $password2) {
        echo "
        <script>
        alert('password tidak sama!');
        </script>
        ";
        return false;
    }

    $result = query("SELECT username FROM user WHERE username = '$username'");

    if ($result) {
        echo "
        <script>
        alert('username sudah ada!');
        </script>
        ";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user VALUES (null,'$username','$password')");
    return mysqli_affected_rows($conn);
}

function login($data)
{
    global $conn;
    $username = $data['username'];
    $password = $data['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username ='$username'");
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            return true;
            exit;
        }
    }
}
