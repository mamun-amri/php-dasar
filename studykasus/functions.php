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
