<?php
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

session_start();
$result = $_SESSION['result'];
array_splice($result, 0, 1);

$selected = explode(' ', $_GET['nama'])[0];
$prints = [];

function getSameData($key, $data, $i)
{
    $res = [];
    foreach ($data as $value) {
        if ($key == $value[1]) {
            $res[] = $value[$i];
        }
    }
    return $res;
}

for ($i = 0; $i < count($result); $i++) {
    $res = explode(',', $result[$i][5]);
    if (in_array($selected, $res) || in_array('Mahasiswa', $res)) {
        $key = $result[$i][1];
        $prints[$key] = [
            'hari' => $result[$i][0],
            'tanggal' => $result[$i][1],
            'dokumentasi' => getSameData($key, $result, 2),
            'kegiatan'  => getSameData($key, $result, 3),
            'deskripsi' => getSameData($key, $result, 4),
            'partisipan' => $result[$i][5],
        ];
    }
    // TODO: Membedakan mana mahasiswa dan mana mahasiswi
}

echo '<pre>';
print_r($prints);
echo '</pre>';

$htmlResult = '';
