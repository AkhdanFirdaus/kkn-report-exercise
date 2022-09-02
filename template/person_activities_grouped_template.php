<?php
session_start();
$sess = $_SESSION['result'];
$person = $_GET['alias'];
$kategori = '';

$nim = $_GET['NIM'];
$nama = $_GET['NAMA'];
$fakultas = $_GET['Fakultas'];
$jurusan = $_GET['Jurusan'];

if (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
}


unset($sess[0]);

$result = [];

// foreach ($sess as $key => $value) {
//     $kegiatan = [];
//     $deskripsi = [];
//     $partisipan = [];
//     $dokumentasi = [];

//     $tanggal = $value[1];
//     $search = explode(',', $value[5]);
//     foreach ($sess as $key => $value2) {
//         if ($tanggal == $value2[1] && (in_array($person, $search) || in_array($kategori, $search))) {
//             $kegiatan[] = $value2[3];
//             $deskripsi[] = $value2[4];
//             $partisipan[] = $value2[5];
//             $dokumentasi[] = $value2[2];
//         }
//     }

//     $result[$tanggal] = [
//         'hari' => $value[0],
//         'tanggal' => $tanggal,
//         'kegiatan' => $kegiatan,
//         'deskripsi' => $deskripsi,
//         'partisipan' => $partisipan,
//         'dokumentasi' => $dokumentasi,
//     ];
// }

foreach ($sess as $key => $value) {
    $search = explode(',', $value[5]);
    if (in_array($person, $search) || in_array($kategori, $search)) {
        $result[$value[1]][] = [
            'hari' => $value[0],
            'tanggal' => $value[1],
            'kegiatan' => $value[3],
            'deskripsi' => $value[4],
            'partisipan' => $value[5],
            'dokumentasi' => $value[2],
        ];
    }
}

?>
<html>

<head>
    <style>
        @page {
            size: A4 potrait;
        }

        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        td.top, th.top {
            vertical-align: top;
        }

        .center {
            text-align: justify;
        }

        ol.list-unstyled, ul.list-unstyled {
            margin:0; 
            padding-left: 20; 
            list-style-position: outside;
        }
        
        .page_break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div>
        <center>
            <h2>LAPORAN KEGIATAN</h2>
            <h2>KKN KELOMPOK 131 DESA CIPAGALO</h2>
            <br>
            <br>
            <img width="30%" src="data:image/jpeg;base64,<?= $logodata ?>" alt="logo" style="margin: 0 auto; text-align:center; display:block;">
            <br>
            <br>
            <h2><?= "$nama ($nim)" ?></h2>
            <h2><?= "Jurusan $jurusan" ?></h2>
            <h2><?= "Fakultas $fakultas" ?></h2>
            <h2>UIN Sunan Gunung Djati Bandung</h2>
        </center>
    </div>
    <?php foreach ($result as $key => $res) : ?>
        <?php $countActivity = count($res) ?>
        <div class="page_break"></div>
        <div>
            <h1 style="text-align: center;">Laporan Kegiatan Harian <a href="https://kkn.uinsgd.ac.id">KKN UIN Sunan Gunung Djati Bandung</a></h1>
            <br>
            <table>
                <tbody>
                    <tr>
                        <th class="top" align="left" width="5%">Jenis KKN</th>
                        <td class="top">:</td>
                        <td width="95%"><a href="https://lp2m.uinsgd.ac.id">KKN Regular Sisdamas</a></td>
                    </tr>
                    <tr>
                        <th class="top" align="left">Hari</th>
                        <td class="top">:</td>
                        <td><?= $res[0]['hari'] ?></td>
                    </tr>
                    <tr>
                        <th class="top" align="left">Tanggal</th>
                        <td class="top">:</td>
                        <td><?= $res[0]['tanggal'] ?></td>
                    </tr>
                    <tr>
                        <th class="top" align="left">Kegiatan</th>
                        <td class="top">:</td>
                        <td style="text-align: justify;">
                            <?php foreach ($res as $value) : ?>
                                <span><?= $value['kegiatan'] ?>, </span>
                            <?php endforeach ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="top" align="left">Deskripsi</th>
                        <td class="top">:</td>
                        <td style="text-align: justify;">
                            <?php if ($countActivity > 1) : ?>
                                <ol class="list-unstyled">
                                    <?php foreach ($res as $value) : ?>
                                        <li class="center""><?= $value['deskripsi'] ?></li>
                                    <?php endforeach ?>
                                </ol>
                            <?php else : ?>
                                <?= $countActivity == 0 ? '-' : $res[0]['deskripsi'] ?>
                            <?php endif ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="top" align="left">Dokumentasi</th>
                        <td class="top">:</td>
                        <td>
                            <?php if ($countActivity > 1) : ?>
                                <ul class="list-unstyled">
                                    <?php foreach ($res as $key => $value) : ?>
                                        <li><a href=" <?= $value['dokumentasi'] ?>">Dokumentasi <?= $value['kegiatan'] ?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            <?php else : ?>
                                <?= $countActivity == 0 ? '-' : '<a href="'. $res[0]['dokumentasi'] . '">' . $res[0]['kegiatan'] . '</a>' ?>
                            <?php endif ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="top" align="left">Partisipan</th>
                        <td class="top">:</td>
                        <td>
                            <?php if ($countActivity > 1) : ?>
                                <ol class="list-unstyled">
                                    <?php foreach ($res as $key => $value) : ?>
                                        <li><?= $value['partisipan'] ?></li>
                                    <?php endforeach ?>
                                </ol>
                            <?php else : ?>
                                <?= $countActivity == 0 ? '-' : $res[0]['partisipan'] ?>
                            <?php endif ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    <?php endforeach ?>
</body>

</html>