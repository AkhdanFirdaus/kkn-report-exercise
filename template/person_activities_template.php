<?php
session_start();
$sess = $_SESSION['result'];
$person = $_GET['nama'];

echo "<pre>";
print_r($sess);
echo "</pre>";

unset($sess[0]);

$result = [];

$mahasiswa = ['Abdul', 'Adhitya', 'Akhdan', 'Aldi', 'Aldo', 'Ghazi', 'M', 'Muhamad', 'Mochammad'];
$mahasiswi = ['Alsa', 'Alfiya', 'Annisa', 'Anzilnie', 'Fitri', 'Ina', 'Yulia'];

foreach ($sess as $key => $value) {
    $names = explode(',', $value[5]);

    if (in_array(explode(' ', $person)[0], $names)) {
        $tanggal = $value[1];
        $result[] = [
            'hari' => $value[0],
            'tanggal' => $tanggal,
            'kegiatan' => $value[3],
            'deskripsi' => $value[4],
            'partisipan' => $value[5],
            'dokumentasi' => $value[2],
        ];
    }

    // if (in_array(explode(' ', $person)[0], $mahasiswa)) {
    //     $tanggal = $value[1];
    //     $result[] = [
    //         'hari' => $value[0],
    //         'tanggal' => $tanggal,
    //         'kegiatan' => $value[3],
    //         'deskripsi' => $value[4],
    //         'partisipan' => $value[5],
    //         'dokumentasi' => $value[2],
    //     ];
    // }

    // if (in_array(explode(' ', $person)[0], $mahasiswi)) {
    //     $tanggal = $value[1];
    //     $result[] = [
    //         'hari' => $value[0],
    //         'tanggal' => $tanggal,
    //         'kegiatan' => $value[3],
    //         'deskripsi' => $value[4],
    //         'partisipan' => $value[5],
    //         'dokumentasi' => $value[2],
    //     ];
    // }
}

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
    <?php foreach ($result as $key => $res) : ?>
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
        <?php if (($key + 1) % count($result) != 0) : ?>
            <div style="page-break-before: always;"></div>
        <?php endif ?>
    <?php endforeach ?>
</body>

</html>