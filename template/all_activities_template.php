<?php
session_start();
$sess = $_SESSION['result'];

unset($sess[0]);

$result = [];

foreach ($sess as $key => $value) {
    $kegiatan = [];
    $deskripsi = [];
    $partisipan = [];
    $dokumentasi = [];

    foreach ($sess as $key => $value2) {
        if ($value[1] == $value2[1]) {
            if ($value2[3] != '-') {
                $kegiatan[] = $value2[3];
            }

            if ($value2[4] != '-') {
                $deskripsi[] = $value2[4];
            }

            if ($value2[5] != '-') {
                $partisipan[] = $value2[5];
            }

            if ($value2[2] != '-') {
                $dokumentasi[] = $value2[2];
            }
        }
    }

    $tanggal = $value[1];
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
        </center>
    </div>
    <div class="page_break"></div>
    <?php foreach ($result as $res) : ?>
        <div>
            <h1 style="text-align: center;">Laporan Kegiatan Harian <a href="https://kkn.uinsgd.ac.id">KKN UIN Sunan Gunung Djati Bandung</a></h1>
            <br>
            <table>
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
                    <td class="center">
                        <?php foreach ($res['kegiatan'] as $value) : ?>
                            <span><?= $value ?>, </span>
                        <?php endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th class="top" align="left">Deskripsi</th>
                    <td class="top">:</td>
                    <td>
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
                            <?= $countDoc == 0 ? '-' : $res['dokumentasi'][0] ?>
                        <?php endif ?>
                    </td>
                </tr>
                <tr>
                    <th class="top" align="left">Partisipan</th>
                    <td class="top">:</td>
                    <td>
                        <?php $countDoc = count($res['partisipan']) ?>
                        <?php if ($countDoc > 1) : ?>
                            <ul class="list-unstyled">
                                <?php foreach ($res['partisipan'] as $value) : ?>
                                    <li><?= $value ?></li>
                                <?php endforeach ?>
                            </ul>
                        <?php else : ?>
                            <?= $countDoc == 0 ? '-' : $res['dokumentasi'][0] ?>
                        <?php endif ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="page_break"></div>
    <?php endforeach ?>
</body>

</html>