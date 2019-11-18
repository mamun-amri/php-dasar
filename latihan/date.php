<!-- 
date()
time()
mktime() 
strtotime()
-->
<?php
// date()
// echo date('l, d M Y');

// time()
// echo time();
// echo date('l, d M Y', time() + 60 * 60 * 24 * 2);

// mktime()
// echo mktime(0, 0, 0, 2, 11, 1997);
// echo date('l , d M Y', mktime(0, 0, 0, 2, 11, 2023));

// strtotime()
// echo date('l', strtotime('11 02 1997'));

function salam($waktu = 'datang', $nama = 'admin')
{
    return "selamat $waktu, $nama!";
}

echo salam('pagi', 'mamun');
?>