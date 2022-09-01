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

foreach ($sess as $key => $value) {
    $kegiatan = [];
    $deskripsi = [];
    $partisipan = [];
    $dokumentasi = [];

    $tanggal = $value[1];
    $search = explode(',', $value[5]);
    foreach ($sess as $key => $value2) {
        if ($tanggal == $value2[1] && (in_array($person, $search) || in_array($kategori, $search))) {
            $kegiatan[] = $value2[3];
            $deskripsi[] = $value2[4];
            $partisipan[] = $value2[5];
            $dokumentasi[] = $value2[2];
        }
    }

    $result[$tanggal] = [
        'hari' => $value[0],
        'tanggal' => $tanggal,
        'kegiatan' => $kegiatan,
        'deskripsi' => $deskripsi,
        'partisipan' => $partisipan,
        'dokumentasi' => $dokumentasi,
    ];
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
            <h1>KKN Kelompok 131 Desa Cipagalo</h1>
            <h2><?= "$nama ($nim)" ?></h2>
            <h2><?= "Jurusan $jurusan" ?></h2>
            <h2><?= "Fakultas $fakultas" ?></h2>
        </center>
    </div>
    <?php foreach ($result as $key => $res) : ?>
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
                        <td><?= $res['hari'] ?></td>
                    </tr>
                    <tr>
                        <th class="top" align="left">Tanggal</th>
                        <td class="top">:</td>
                        <td><?= $res['tanggal'] ?></td>
                    </tr>
                    <tr>
                        <th class="top" align="left">Kegiatan</th>
                        <td class="top">:</td>
                        <td style="text-align: justify;">
                            <?php foreach ($res['kegiatan'] as $value) : ?>
                                <span><?= $value ?>, </span>
                            <?php endforeach ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="top" align="left">Deskripsi</th>
                        <td class="top">:</td>
                        <td style="text-align: justify;">
                            <?php $countDesc = count($res['deskripsi']) ?>
                            <?php if (count($res['deskripsi']) > 1) : ?>
                                <ol class="list-unstyled">
                                    <?php foreach ($res['deskripsi'] as $value) : ?>
                                        <li class="center""><?= $value ?></li>
                                    <?php endforeach ?>
                                </ol>
                            <?php else : ?>
                                <?= $countDesc == 0 ? '-' : $res['deskripsi'][0] ?>
                            <?php endif ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="top" align="left">Dokumentasi</th>
                        <td class="top">:</td>
                        <td>
                            <?php $countDoc = count($res['dokumentasi']) ?>
                            <?php if ($countDoc > 1) : ?>
                                <ul class="list-unstyled">
                                    <?php for ($i = 0; $i < count($res['dokumentasi']); $i++) : ?>
                                        <li><a href=" <?= $res['dokumentasi'][$i] ?>">Dokumentasi <?= $res['kegiatan'][$i] ?></a></li>
                                    <?php endfor ?>
                                </ul>
                            <?php else : ?>
                                <?= $countDoc == 0 ? '-' : '<a href="'. $res['dokumentasi'][0] . '">' . $res['kegiatan'][0] . '</a>' ?>
                            <?php endif ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="top" align="left">Partisipan</th>
                        <td class="top">:</td>
                        <td>
                            <?php $countDoc = count($res['partisipan']) ?>
                            <?php if ($countDoc > 1) : ?>
                                <ol class="list-unstyled">
                                    <?php foreach ($res['partisipan'] as $value) : ?>
                                        <li><?= $value ?></li>
                                    <?php endforeach ?>
                                </ol>
                            <?php else : ?>
                                <?= $countDoc == 0 ? '-' : $res['partisipan'][0] ?>
                            <?php endif ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    <?php endforeach ?>
</body>

</html>