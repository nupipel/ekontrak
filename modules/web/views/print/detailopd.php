<!doctype html>
<?php
$base_assets = base_url() . 'cc-content/themes/cicool/rukada/assets/';
// var_dump($subkegiatan);
// die;
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? false; ?></title>
    <link href="<?= $base_assets ?>css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <input type="hidden" value="<?= $tahun; ?>" id="inp_tahun">
        <input type="hidden" value="<?= $instansi; ?>" id="inp_instansi">
        <input type="hidden" value="<?= $kegiatan; ?>" id="inp_kegiatan">
        <br>
        <br>
        <div class="row contacts">
            <div class="col-8">
                <div class="row">
                    <div class="text-gray-light col-2">UNIT</div>
                    <div class="text-gray-light col" id="text_unit"></div>
                </div>
                <div class="row">
                    <div class="text-gray-light col-2">KEGIATAN</div>
                    <div class="text-gray-light col" id="text_kegiatan"></div>
                </div>
                <div class="row">
                    <div class="text-gray-light col-2">TAHUN</div>
                    <div class="text-gray-light col" id="text_tahun"></div>
                </div>
            </div>
            <div class="col-4">
                <div class="text-end">
                    <button type="button" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
                    <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                </div>
            </div>
        </div>
        <hr style="border-top: 5px dashed black;">
        <br>
        <div class="table-responsive" id='formDetailAPBD'>

        </div>
    </div>

    <script src="<?= $base_assets ?>js/bootstrap.bundle.min.js"></script>
    <script src="<?= $base_assets ?>js/jquery.min.js"></script>
    <!-- loadingOverlay  -->
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>



    <script>
        const csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

        function printDetail() {
            const tahun = $("#inp_tahun").val();
            const instansi = $('#inp_instansi').val();
            const kegiatan = $('#inp_kegiatan').val();
            $.ajax({
                url: "<?= base_url() . 'web/printDetailAPBD' ?>",
                dataType: "JSON",
                type: "POST",
                data: {
                    [csrfName]: csrfHash,
                    tahun: tahun,
                    instansi: instansi,
                    kegiatan: kegiatan
                },
                beforeSend: function() {
                    $("#formDetailAPBD").empty();
                    $("body").LoadingOverlay("show");
                },
                success: function(res) {
                    $('#text_unit').text(":  " + res.unit);
                    $('#text_kegiatan').text(":  " + res.kegiatan);
                    $('#text_tahun').text(":  <?= $tahun ?>");

                    const data = res.subkegiatan;

                    $.each(data, function(a, subkegiatan) {
                        let kodeAkun = "";
                        let html =
                            '<table class="table table-bordered">' +
                            '<thead>' +
                            '<tr class="table-primary">' +
                            '<th style="width:20%">SUBKEGIATAN</th>' +
                            '<th style="width:60%"><strong>' + subkegiatan.kode_subkegiatan + ' ' + subkegiatan.nama_subkegiatan + '</strong></th>' +
                            '<td style="width:20%"></td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th>KODE REKENING</th>' +
                            '<th>URAIAN</th>' +
                            '<th>JUMLAH</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';

                        $.each(subkegiatan.akun, function(b, akun) {
                            html += '<tr>' +
                                '<td><STRONG>' + akun.kode_akun + '</STRONG></td>' +
                                '<td class="text-left">' +
                                '<STRONG>' + akun.nama_akun + '</STRONG>' +
                                '</td>' +
                                '<td class="unit"></td>' +
                                '</tr>';
                            $.each(akun.subs, function(c, subs) {
                                html += '<tr>' +
                                    '<td></td>' +
                                    '<td>' + subs.subs_bl + '</td>' +
                                    '<td></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td></td>' +
                                    '<td>' + subs.ket_bl + '</td>' +
                                    '<td></td>' +
                                    '</tr>';
                                $.each(subs.komponen, function(d, komponen) {
                                    html += '<tr>' +
                                        '<td></td>' +
                                        '<td>' + komponen.nama_komponen + '</td>' +
                                        '<td><b>' + komponen.harga_total + '</b></td>' +
                                        '</tr>';
                                })
                            })
                        });

                        html += '</tbody>' +
                            '</table>' +
                            $("#formDetailAPBD").append(html);
                    })
                }
            }).always(function() {
                $("body").LoadingOverlay("hide", true);
            })
        };


        $(function() {
            printDetail();
        })
    </script>

</body>

</html>