$(document).ready(function () {

    $('#btn-cari').hide();
    $('.loaded').hide();

    $('#keyword').on('keyup', function () {
        // ajak menggunakan load
        // $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());

        $('.loaded').show();

        // ajak menggunakan $.get()
        $.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(), function (data) {
            $('#container').html(data);
            $('.loaded').hide();
        });

    });

    // print 
    $('.cetak').on('click', function (e) {
        e.preventDefault();
        let href = $(this).attr('href');
        let conf = confirm('cetak!');
        if (conf) {
            document.location.href = href;
        }
    });

});