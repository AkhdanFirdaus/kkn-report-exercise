<?php
session_start();
$sess = $_SESSION['result'];
$kegiatan = $_GET['kegiatan'];

unset($sess[0]);

$res = [];

foreach ($sess as $key => $value) {
    if ($value[3] == $kegiatan) {
        $tanggal = $value[1];
        $res = [
            'hari' => $value[0],
            'tanggal' => $tanggal,
            'kegiatan' => $value[3],
            'deskripsi' => $value[4],
            'partisipan' => $value[5],
            'dokumentasi' => $value[2],
        ];
        break;
    }
}

// echo '<pre>';
// print_r($sess);
// echo '</pre>';

?>
<html>

<head>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <div>
        <h1 style="text-align: center;">Laporan Kegiatan Harian <a href="https://kkn.uinsgd.ac.id">KKN UIN Sunan Gunung Djati Bandung</a></h1>
        <br>
        <table>
            <tr>
                <th style="vertical-align: top;" align="left" width="5%">Jenis KKN</th>
                <td style="vertical-align: top;">:</td>
                <td width="95%"><a href="https://lp2m.uinsgd.ac.id">KKN Regular Sisdamas</a></td>
            </tr>
            <tr>
                <th style="vertical-align: top;" align="left">Hari</th>
                <td style="vertical-align: top;">:</td>
                <td><?= $res['hari'] ?></td>
            </tr>
            <tr>
                <th style="vertical-align: top;" align="left">Tanggal</th>
                <td style="vertical-align: top;">:</td>
                <td><?= $res['tanggal'] ?></td>
            </tr>
            <tr>
                <th style="vertical-align: top;" align="left">Kegiatan</th>
                <td style="vertical-align: top;">:</td>
                <td style="text-align: justify;">
                    <span><?= $res['kegiatan'] ?>, </span>
                </td>
            </tr>
            <tr>
                <th style="vertical-align: top;" align="left">Deskripsi</th>
                <td style="vertical-align: top;">:</td>
                <td style="text-align: justify;">
                    <?= $res['deskripsi'] ?>
                </td>
            </tr>
            <tr>
                <th style="vertical-align: top;" align="left">Dokumentasi</th>
                <td style="vertical-align: top;">:</td>
                <td>
                    <a href="<?= $res['dokumentasi'] ?>">Link Dokumentasi</a>
                </td>
            </tr>
            <tr>
                <th style="vertical-align: top;" align="left">Partisipan</th>
                <td style="vertical-align: top;">:</td>
                <td>
                    <?= $res['partisipan'] ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</body>

</html>