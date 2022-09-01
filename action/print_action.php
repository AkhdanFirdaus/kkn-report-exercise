<?php
require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);
$dompdf->setPaper('A4', 'potrait');

$type = $_GET['type'];

switch ($type) {
    case 'all':
        ob_start();
        require('../template/all_activities_template.php');
        $dompdf->loadHtml(ob_get_clean());
        $dompdf->render();
        $dompdf->stream('laporan_semua_kegiatan.pdf');
        break;
    case 'single':
        ob_start();
        require('../template/activity_template.php');
        $dompdf->loadHtml(ob_get_clean());
        $dompdf->render();
        $dompdf->stream('laporan_kegiatan.pdf');
        break;
    case 'person':
        ob_start();
        require('../template/person_activities_template.php');
        $dompdf->loadHtml(ob_get_clean());
        $dompdf->render();
        $dompdf->stream('laporan_kegiatan_' . $_GET['nama'] . '.pdf');
        break;
    default:
        break;
}
