document.addEventListener("DOMContentLoaded", function () {
    const sidebarToggle = document.querySelector(".toggle-btn");
    const sidebar = document.querySelector(".custom-sidebar");
    const contentWrapper = document.querySelector(".content-wrapper");
    const content = document.querySelector(".main-content");

    if (localStorage.getItem("sidebarState") === "collapsed") {
        sidebar.classList.add("collapsed");
        contentWrapper.classList.add("full");
        content.classList.add("full-width");
    }

    sidebarToggle.addEventListener("click", function () {
        sidebar.classList.toggle("collapsed");
        contentWrapper.classList.toggle("full");
        content.classList.toggle("full-width");

        if (sidebar.classList.contains("collapsed")) {
            localStorage.setItem("sidebarState", "collapsed");
        } else {
            localStorage.setItem("sidebarState", "expanded");
        }
    });

    document.querySelectorAll(".toggle-submenu").forEach(item => {
        item.addEventListener("click", function (e) {
            e.preventDefault();
            this.parentElement.classList.toggle("active");
        });
    });
});

    // Event saat tombol tambah barang diklik
    $('.tombolTambahBarang').on('click', function() {
        $('#formModalLabel').html('Tambah Data Motor');
        $('.modal-footer button[type=submit]').html('Simpan');
    });

    // Event saat tombol edit barang diklik
    $('.tampilModalUbahBarang').on('click', function() {
        $('#formModalLabel').html('Ubah Data Motor');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('.modal-body form').attr('action', BASEURL + '/barang/ubah');

        const id = $(this).data('id');

        $.ajax({
            url: BASEURL + '/barang/getUbah',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(data) {
                $('#id').val(data.id);
                $('#nama_motor').val(data.nama_motor);
                $('#jumlah_motor').val(data.jumlah_motor);
                $('#supplier').val(data.id_supplier);
                $('#tanggal_masuk').val(data.tanggal_masuk);
            }
        });
    });

    $(document).ready(function() {
        // Event saat tombol tambah distribusi diklik
        $('.tombolTambahDistribusi').on('click', function() {
            $('#formModalLabel').html('Tambah Data Distribusi');
            $('.modal-footer button[type=submit]').html('Simpan');
        });
    
        // Event saat tombol edit distribusi diklik
        $('.tampilModalUbahDistribusi').on('click', function() {
            $('#formModalLabel').html('Ubah Data Distribusi');
            $('.modal-footer button[type=submit]').html('Ubah Data');
            $('.modal-body form').attr('action', BASEURL + '/distribusi/ubah');
            
            const id = $(this).data('id');
            
            $.ajax({
                url: BASEURL + '/distribusi/getUbah',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(data) {
                    $('#id_distribusi').val(data.id_distribusi);
                    $('#id_barang').val(data.id_barang);
                    $('#jumlah').val(data.jumlah);
                    $('#tujuan').val(data.tujuan);
                    $('#tanggal_kirim').val(data.tanggal_kirim);
                    $('#status').val(data.status);
                }
            });
        });
    });
    

