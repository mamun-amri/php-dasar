<!-- 1. for
2. while
3. do.. while..
4. foreach.. -->

<?php
// for ($i = 0; $i < 5; $i++) {
//     echo 'hello world </br>';
// }


// $i = 0;
// while ($i < 5) {
//     echo 'hello world <br>';
//     $i++;
// }


// $i = 0;
// do {
//     echo 'hello world <br>';
//     $i++;
// } while ($i < 5);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pengulangan</title>
    <style>
        .warna-baris {
            background-color: silver;
        }

        .warna-kolom {
            background-color: linen;
        }
    </style>
</head>

<body>
    <table border="1" cellpadding="10" collpadding="0">
        <?php for ($i = 1; $i <= 5; $i++) : ?>
            <?php if ($i % 2 == 1) : ?>
                <tr class="warna-baris">
                <?php else : ?>
                <tr>
                <?php endif; ?>
                <?php for ($j = 1; $j <= 5; $j++) : ?>
                    <?php if ($j % 2 == 1) : ?>
                        <td class="warna-kolom"><?= $i . ',' . $j ?></td>
                    <?php else : ?>
                        <td><?= $i . ',' . $j ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
                </tr>
            <?php endfor; ?>
    </table>
</body>

</html>