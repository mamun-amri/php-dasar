var keyword = document.getElementById('keyword');
var btnCari = document.getElementById('btn-cari');
var container = document.getElementById('container');

keyword.addEventListener('keyup', function () {
    // bikin XMLHttpRequest
    var xhr = new XMLHttpRequest();
    // cek kesiapan ajax
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // ini yang akan merespos dari eksekusi ajax
            container.innerHTML = xhr.responseText;
        }
    }

    // eksekusi ajax
    // (methode,file yang akan ditampilkan/dipanggil,synchronous)
    xhr.open('GET', 'ajax/mahasiswa.php?keyword=' + keyword.value, true);
    xhr.send();

});