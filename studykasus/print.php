<?php
require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

$html = '
<h1>Data Mahasiswa</h1>
<table border="1" cellpadding="10" callpadding="0">
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>NRP</th>
                <th>Email</th>
                <th>Jurusan</th>
            </tr>';
$i = 1;
foreach ($mahasiswa as $mhs) :
    $html .= '<tr>
        <td>' . $i++ . '</td>
        <td><img src="img/' . $mhs['gambar'] . '" width="50"></td>
        <td>' . $mhs['nama'] . '</td>
        <td>' . $mhs['nrp'] . '</td>
        <td>' . $mhs['email'] . '</td>
        <td>' . $mhs['jurusan'] . '</td>
    </tr>';
endforeach;
$html .= '</table>';

// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output('mhs.pdf', 'D');
