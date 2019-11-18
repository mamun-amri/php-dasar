<?php
$mahasiswa = [
    ['mamun', '1101161096', 'mamun@gmail.com'],
    ['amri', '1101161006', 'amri@gmail.com']
];
foreach ($mahasiswa as $mhs) : ?>
    <ul>
        <li>nama : <?= $mhs[0]; ?></li>
        <li>npm : <?= $mhs[1]; ?></li>
        <li>email : <?= $mhs[2]; ?></li>
    </ul>
<?php endforeach; ?>
<br>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>array</title>
    <style>
        .kotak {
            background-color: greenyellow;
            height: 50px;
            width: 50px;
            line-height: 50px;
            text-align: center;
            margin: 3px;
            float: left;
            transition: 1s;
        }

        .kotak:hover {
            transform: rotate(360deg);
            border-radius: 50%;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>
    <?php
    $angka = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9]
    ];
    ?>
    <h1>Latihan array assosiatif</h1>
    <?php foreach ($angka as $n) : ?>
        <?php foreach ($n as $a) : ?>
            <div class="kotak"><?= $a; ?></div>
        <?php endforeach; ?>
        <div class="clear"></div>
    <?php endforeach; ?>
</body>

</html>