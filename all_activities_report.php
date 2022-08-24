<?php
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;
// [0] => Senin
// [1] => 25-07-2022
// [2] => https://drive.google.com/drive/folders/1OsmlYdzYrPZCrdtdFk8rSPyXNyOtmoEk?usp=sharing
// [3] => Serah Terima Peserta KKN 2022 dengan Pihak Desa
// [4] => Serah terima diadakan secara luring (tatap muka) di kantor Desa Cipagalo yang dihadiri langsung oleh kepala desa yaitu bapak H. Asep Sobari, dosen pembimbing lapangan (DPL) yaitu Ibu Neng Gustini, dan 3 kelompok peserta KKN Reguler Sisdamas yang ditempatkan di beberapa titik RW Desa Cipagalo yaitu RW 5, RW 6 dan RW 7. Dalam serah terima tersebut kepala desa memberi sambutan berupa arahan mengenai pelaksanaan KKN di desa Cipagalo dan gambaran umum mengenai desa Cipagalo. Setelah kepala desa memberi sambutan, kemudian dilanjutkan dengan penguatan dari DPL mengenai pelaksanaan KKN yang akan dilaksanakan. Berdasarkan hal tersebut, kepala desa memberitahu peserta KKN mengenai program yang dilaksankan di desa agar seluruh peserta dapat berpartisipasi dalam program tersebut, diantaranya adalah program 17 Agustus, pembuatan kandang untuk ternak kambing dan lele serta kebersihan lingkungan.
// [5] => Mahasiswa,Mahasiswi

session_start();
$result = $_SESSION['result'];
$html = '';
$html .= '<html>';
$html .= '<body>';
// echo '<pre>';
// print_r($result);
// echo '</pre>';
foreach ($result as $res) {
    $html .= '<div>';
    $html .= '<h1 style="text-align: center;">Laporan Kegiatan Harian <a href="https://kkn.uinsgd.ac.id">KKN UIN Sunan Gunung Djati Bandung</a></h1>';
    $html .= '<br>';
    $html .= '<table class="table-auto border-collapse border border-slate-400">';
    $html .= '<tr>';
    $html .= '<th class="v-top" style="vertical-align: top;" align="left" width="5%">Jenis KKN</th>';
    $html .= '<td class="v-top" style="vertical-align: top;">:</td>';
    $html .= '<td width="95%"><a href="https://lp2m.uinsgd.ac.id">KKN Regular Sisdamas</a></td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<th class="v-top" style="vertical-align: top;" align="left">Hari</th>';
    $html .= '<td class="v-top" style="vertical-align: top;">:</td>';
    $html .= '<td>' . $res[0] . '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<th class="v-top" style="vertical-align: top;" align="left">Tanggal</th>';
    $html .= '<td class="v-top" style="vertical-align: top;">:</td>';
    $html .= '<td>' . $res[1] . '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<th class="v-top" style="vertical-align: top;" align="left">Kegiatan</th>';
    $html .= '<td class="v-top" style="vertical-align: top;">:</td>';
    $html .= '<td style="text-align: justify;">' . $res[3] . '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<th class="v-top" style="vertical-align: top;" align="left">Deskripsi</th>';
    $html .= '<td class="v-top" style="vertical-align: top;">:</td>';
    $html .= '<td>';
    $html .= '<ol style="margin: 0;padding: 0;list-style-position: inside;">';
    $html .= '<li>' . $res[4] . '</li>';
    // for ($i = 0; $i < 3; $i++) {
    //     $html .= '<li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, quae.</li>';
    // }
    $html .= '</ol>';
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<th class="v-top" style="vertical-align: top;" align="left">Dokumentasi</th>';
    $html .= '<td class="v-top" style="vertical-align: top;">:</td>';
    $html .= '<td>';
    $html .= '<ul style="margin: 0;padding: 0;list-style-position: inside;">';
    $html .= '<li>' . $res[5] . '</li>';
    // for ($i = 0; $i < 3; $i++) {
    //     $html .= '<li><a href="">Lorem ipsum dolor sit amet.</a></li>';
    //     $html .= '<li><a href="">Lorem ipsum dolor sit amet.</a></li>';
    // }
    $html .= '</ul>';
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>';
    $html .= '<div style="page-break-before: always;"></div>';
}
$html .= '</body>';
$html .= '</html>';
echo $html;
$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);
$dompdf->setPaper('A4', 'potrait');
$dompdf->loadHtml($html);
$dompdf->render();
ob_end_clean();
$dompdf->stream('laporan_semua_kegiatan.pdf');
