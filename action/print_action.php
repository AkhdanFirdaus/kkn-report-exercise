<?php
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$logo=file_get_contents("../assets/logo.jpeg");
$logodata=base64_encode($logo);

$options = new Options();
$options->set('defaultFont', 'Arial');
$options->set('isRemoteEnabled', true);
$options->set('enable_html5_parser',true);
$options->set('tempDir','C:\xampp\htdocs');
$dompdf = new Dompdf($options);
$dompdf->setPaper('A4', 'potrait');

$type = $_GET['type'];

switch ($type) {
    case 'all':
        ob_start();
        require('../template/all_activities_template.php');
        $dompdf->loadHtml(ob_get_clean());
        // $dompdf->loadHtml(require('../template/all_activities_template.php'));
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
        $dompdf->stream('laporan_kegiatan_' . $_GET['alias'] . '.pdf');
        break;
    case 'personactivity':
        ob_start();
        // $dompdf->loadHtml(require('../template/person_activities_grouped_template.php'));
        require('../template/person_activities_grouped_template.php');
        $dompdf->loadHtml(ob_get_clean());
        $dompdf->render();
        $dompdf->stream('laporan_kegiatan_' . $_GET['alias'] . '.pdf');
        break;
    default:
        break;
}
