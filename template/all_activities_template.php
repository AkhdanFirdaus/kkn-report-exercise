<?php
session_start();
$sess = $_SESSION['result'];
$profileResult = $_SESSION['profilResult'];
array_splice($profileResult, 0, 1);

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

        .justify {
            text-align: justify;
        }

        .center {
            text-align: center;
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
        <h2 class="center">LAPORAN KEGIATAN</h2>
        <h2 class="center">KKN KELOMPOK 131 DESA CIPAGALO</h2>
        <br>
        <br>
        <center>
            <img width="30%" src="data:image/jpeg;base64,<?= $logodata ?>" alt="logo" style="margin: 0 auto; text-align:center; display:block;">
        </center>
        <br>
        <br>
        <h3 class="center">DPL     : Neng Gustini, S.Pd., M.Pd</h3>
        <h3 class="center">Ketua   : <?= $profileResult[13][1] ?> (<?= $profileResult[13][0] ?>)</h3>
        <h3 class="center">Anggota :</h3>
        <div style="width: 24rem; margin:0 auto;">
            <ul>
                <?php foreach ($profileResult as $key => $profile) : 
                    if ($key != 13) :
                ?>
                    <li><?= "$profile[1] ($profile[0])" ?></li>                    
                <?php
                    endif; 
                    endforeach; 
                ?>
            </ul>
        </div>
        <h1 class="center">UIN Sunan Gunung Djati Bandung</h1>
    </div>
    <?php foreach ($result as $res) : ?>
        <div class="page_break"></div>
        <div>
            <h1 class="center">Laporan Kegiatan Harian <a href="https://kkn.uinsgd.ac.id">KKN UIN Sunan Gunung Djati Bandung</a></h1>
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
                    <td class="justify">
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
                                    <li class="justify""><?= $value ?></li>
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