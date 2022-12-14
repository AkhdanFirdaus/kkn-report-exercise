<?php
session_start();
$sess = $_SESSION['result'];
$person = $_GET['alias'];
$kategori = '';

if (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
}


unset($sess[0]);

$result = [];

foreach ($sess as $key => $value) {
    if (in_array($person, explode(',', $value[5]))) {
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

    if ($kategori != '' && in_array($kategori, explode(',', $value[5]))) {
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
    <?php foreach ($result as $key => $res) : ?>
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
                    <td style="text-align: justify;">
                        <span><?= $res['kegiatan'] ?>, </span>
                    </td>
                </tr>
                <tr>
                    <th class="top" align="left">Deskripsi</th>
                    <td class="top">:</td>
                    <td style="text-align: justify;">
                        <?= $res['deskripsi'] ?>
                    </td>
                </tr>
                <tr>
                    <th class="top" align="left">Dokumentasi</th>
                    <td class="top">:</td>
                    <td>
                        <a href="<?= $res['dokumentasi'] ?>">Link Dokumentasi</a>
                    </td>
                </tr>
                <tr>
                    <th class="top" align="left">Partisipan</th>
                    <td class="top">:</td>
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