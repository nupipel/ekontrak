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
    <title><?= $title; ?></title>
    <link href="<?= $base_assets ?>css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <table class="table table-bordered" style="border-collapse: collapse; " width="100%">
            <tbody>
                <tr style="height: 15.0pt;">
                    <td class="xl86" style="width: 503pt; height: 15.0pt;" colspan="3" width="671" height="20">Rincian Perubahan Anggaran Belanja Kegiatan Satuan Kerja Perangkat Daerah</td>
                </tr>
                <?php for ($a = 0; $a < count($subkegiatan); $a++) : ?>
                    <tr style="height: 15.0pt;">
                        <td class="xl86" style="width: 503pt; height: 15.0pt;" colspan="3" width="671" height="20"><strong>Sub Kegiatan : <?= $subkegiatan[$a]['kode']; ?>&nbsp;<?= $subkegiatan[$a]['nama']; ?></strong></td>
                    </tr>
                    <tr style="height: 15.0pt;">
                        <th class="xl87" style="height: 15.0pt;" height="20">Kode Rekening</th>
                        <th class="xl88">Uraian</th>
                        <th class="xl87">Jumlah</th>
                    </tr>
                    <?php for ($b = 0; $b < count($subkegiatan[$a]['data_rka']); $b++) : ?>
                        <tr style="height: 15.0pt;">
                            <td class="xl71" style="height: 15.0pt;" height="20"><?= $subkegiatan[$a]['data_rka'][$b]["kode_akun"] ?></td>
                            <td class="xl71"><?= $subkegiatan[$a]['data_rka'][$b]["nama_akun"] ?></td>
                            <td class="xl71">Rp. 0</td>
                        </tr>
                        <?php for ($c = 0; $c < count($subkegiatan[$a]['data_rka'][$b]["detailakun"]); $c++) : ?>
                            <tr style="height: 15.0pt;">
                                <td></td>
                                <td class="xl71" style="height: 15.0pt;" height="20"><?= $subkegiatan[$a]['data_rka'][$b]["detailakun"][$c]->subs_bl_teks ?></td>
                                <td class="xl71">Rp. 0</td>
                            </tr>
                            <tr style="height: 15.0pt;">
                                <td></td>
                                <td class="xl71"><?= $subkegiatan[$a]['data_rka'][$b]["detailakun"][$c]->ket_bl_teks ?></td>
                                <td class="xl71">Rp. 0</td>
                            </tr>
                        <?php endfor; ?>
                    <?php endfor; ?>
                    <tr border="0">
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endfor; ?>


            </tbody>
        </table>
    </div>

    <script src="<?= $base_assets ?>js/bootstrap.bundle.min.js"></script>

</body>

</html>