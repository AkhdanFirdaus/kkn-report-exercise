<?php
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

session_start();
$profilResult = $_SESSION['profilResult'];
$result = $_SESSION['result'];

$htmlResult = '';

$hari = $result[1][0];
$tanggal = $result[1][1];
$kegiatan = '<li>' .  $result[1][3] . '</li>';
$deskripsi = '<li>' .  $result[1][4] . '</li>';
$dokumentasi = '<li><a href="' . $result[1][2] . '">' . $result[1][3] . '</a></li>';

$i = 1;
while ($i <= count($result)) {
    if ($i != 1 && $result[$i][1] == $tanggal) {
        $kegiatan .= '<li>' . $result[$i][3] . '</li>';
        $deskripsi .= '<li>' . $result[$i][4] . '</li>';
        $dokumentasi .= '<li><a href="' . $result[$i][2] . '">' . $result[$i][3] . '</a></li>';
    }

    $i++;
}

$htmlResult .= '<table class="table-auto border-collapse border border-slate-400">';
$htmlResult .= '<tr>';
$htmlResult .= '<th align="left" width="5%">Jenis KKN</th>';
$htmlResult .= '<td>:</td>';
$htmlResult .= '<td width="95%"><a href="https://lp2m.uinsgd.ac.id">KKN Regular Sisdamas</a></td>';
$htmlResult .= '</tr>';
$htmlResult .= '<tr>';
$htmlResult .= '<th align="left">Hari</th>';
$htmlResult .= '<td>:</td>';
$htmlResult .= '<td>' . $hari . '</td>';
$htmlResult .= '</tr>';
$htmlResult .= '<tr>';
$htmlResult .= '<th align="left">Tanggal</th>';
$htmlResult .= '<td>:</td>';
$htmlResult .= '<td>' . $tanggal . '</td>';
$htmlResult .= '</tr>';
$htmlResult .= '<tr>';
$htmlResult .= '<th style="vertical-align: top;" align="left">Kegiatan</th>';
$htmlResult .= '<td>:</td>';
$htmlResult .= '<td><ul>' . $kegiatan . '</ul></td>';
$htmlResult .= '</tr>';
$htmlResult .= '<tr>';
$htmlResult .= '<th style="vertical-align: top;" align="left">Deskripsi</th>';
$htmlResult .= '<td style="vertical-align: top;">:</td>';
$htmlResult .= '<td><ul>' . $deskripsi . '</ul></td>';
$htmlResult .= '</tr>';
$htmlResult .= '<tr>';
$htmlResult .= '<th align="left">Dokumentasi</th>';
$htmlResult .= '<td>:</td>';
$htmlResult .= '<td><ul>' . $dokumentasi . '</ul></td>';
$htmlResult .= '</tr>';
$htmlResult .= '</tbody>';
$htmlResult .= '</table>';

$nama = 'logbook-' . time();
$pdf = new Dompdf();
$pdf->setPaper('A4', 'potrait');
$pdf->loadHtml($htmlResult);
$pdf->render();
// $pdf->stream($nama, ['Attachment' => 0]);
$output = $pdf->output();
// file_put_contents($nama, $output);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1 style="text-align: center;">Laporan Kegiatan Harian <a href="https://kkn.uinsgd.ac.id">KKN UIN Sunan Gunung Djati Bandung</a></h1>
    <?= $htmlResult ?>
</body>

</html>