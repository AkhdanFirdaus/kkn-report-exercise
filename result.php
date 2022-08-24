<?php

session_start();
$profilResult = $_SESSION['profilResult'];
array_splice($profilResult, 0, 1);

$result = $_SESSION['result'];
array_splice($result, 0, 1);

$htmlResult = '';

if (isset($result)) {
    $htmlResult .= '<table class="table-auto border-collapse border border-slate-400 w-100">';
    $htmlResult .= '<thead>';
    $htmlResult .= '<tr>';
    $htmlResult .= '<th class="border border-slate-300 px-3 py-1.5">No</th>';
    $htmlResult .= '<th class="border border-slate-300 px-3 py-1.5">Hari</th>';
    $htmlResult .= '<th class="border border-slate-300 px-3 py-1.5">Tanggal</th>';
    $htmlResult .= '<th class="border border-slate-300 px-3 py-1.5">Kegiatan</th>';
    $htmlResult .= '<th class="border border-slate-300 px-3 py-1.5">#</th>';
    $htmlResult .= '</tr>';
    $htmlResult .= '</thead>';
    $htmlResult .= '<tbody>';
    for ($i = 0; $i < count($result); $i++) {
        $htmlResult .= '<tr>';
        $htmlResult .= '<td class="border border-slate-300 px-3 py-1.5">' . $i + 1 . '</td>';
        $htmlResult .= '<td class="border border-slate-300 px-3 py-1.5">' . $result[$i][0] . '</td>';
        $htmlResult .= '<td class="border border-slate-300 px-3 py-1.5">' . $result[$i][1] . '</td>';
        $htmlResult .= '<td class="border border-slate-300 px-3 py-1.5">' . $result[$i][3] . '</td>';
        $htmlResult .= '<td class="border border-slate-300 px-3 py-1.5">';
        $htmlResult .= '<a href="" class="bg-purple-500 text-white rounded px-2 py-1.5">Print</a>';
        $htmlResult .= '</td>';
        $htmlResult .= '</tr>';
    }
    $htmlResult .= '</tbody>';
    $htmlResult .= '</table>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="grid grid-cols-2 gap-4 m-5">
        <div class="bg-white shadow rounded px-6 py-8 flex flex-col space-y-4">
            <span class="text-2xl font-bold"><?= count($profilResult) - 1 ?> Anggota Tim</span>
            <h1>Profil Tim</h1>
            <div class="block">
                <button type="button" id="cta-team-button" class="bg-purple-500 text-white px-2 py-1.5 rounded shadow">Lihat Profil Anggota</button>
            </div>
        </div>
        <div class="bg-white shadow rounded px-6 py-8 flex flex-col space-y-4">
            <span class="text-2xl font-bold"><?= count($result) ?></span>
            <h1>Kegiatan</h1>
            <div class="block">
                <button type="button" id="cta-logbook-button" class="bg-purple-500 text-white px-2 py-1.5 rounded shadow">Lihat Kegiatan</button>
            </div>
        </div>
    </div>
    <div>
        <div id="logbook-container" class="p-5 bg-slate-500 hidden">
            <div class="bg-white rounded px-6 py-8 shadow">
                <div class="flex justify-between flex-row w-full">
                    <form method="POST" action="all_activities_report.php" class="inline-block">
                        <h1 class="font-bold text-2xl inline-block">Logbook</h1>
                        <button type="submit" name="print_button" class="px-3 py-1.2 rounded bg-purple-500 text-white">Print All</button>
                    </form>
                </div>
                <div class="my-8"></div>
                <div class="table-responsive">
                    <?php $i = 1;
                    if (isset($htmlResult)) {
                        echo $htmlResult;
                    } ?>
                </div>
            </div>
        </div>
        <div id="team-container" class="p-5 bg-slate-500 hidden">
            <div class="bg-white rounded px-6 py-8 shadow">
                <div class="grid grid-cols-2 gap-4 m-5">
                    <div>
                        <h1 class="font-bold text-2xl">Profil</h1>
                        <div class="my-8"></div>
                        <?php $i = 1;
                        if (isset($profilResult)) : ?>
                            <table class="table-auto border-collapse border border-slate-400">
                                <thead>
                                    <tr>
                                        <th class="border border-slate-300 px-3 py-1.5">No</th>
                                        <th class="border border-slate-300 px-3 py-1.5">NIM</th>
                                        <th class="border border-slate-300 px-3 py-1.5">Nama</th>
                                        <th class="border border-slate-300 px-3 py-1.5">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($profilResult); $i++) : ?>
                                        <tr>
                                            <td class="border border-slate-300 px-3 py-1.5"><?= $i + 1 ?></td>
                                            <td class="border border-slate-300 px-3 py-1.5"><?= $profilResult[$i][0] ?></td>
                                            <td class="border border-slate-300 px-3 py-1.5"><?= $profilResult[$i][1] ?></td>
                                            <td class="border border-slate-300 px-3 py-1.5">
                                                <button type="button" class="bg-purple-500 text-white rounded px-2 py-1.5" onclick="onClickDetail('<?= $profilResult[$i][0] ?>', '<?= $profilResult[$i][1] ?>', '<?= $profilResult[$i][2] ?>', '<?= $profilResult[$i][3] ?>')">Detail</button>
                                                <form action="single_report.php" class="inline-block" method="GET">
                                                    <input type="hidden" name="nama" value="<?= $profilResult[$i][1] ?>">
                                                    <button name="single_report_button" type="submit" class="bg-purple-500 text-white rounded px-2 py-1.5">Print</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endfor ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                    <div id="team-detail-container" class="bg-slate-200 rounded p-5">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, omnis modi autem placeat voluptatum ducimus, error eius nisi et vitae culpa adipisci quia? Accusantium ipsa obcaecati at quasi accusamus rem!
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const logbookContainer = document.getElementById('logbook-container')
        const teamContainer = document.getElementById('team-container')
        const teamDetailContainer = document.getElementById('team-detail-container')

        document.getElementById('cta-logbook-button').addEventListener('click', function() {
            logbookContainer.classList.toggle('hidden')
        })

        document.getElementById('cta-team-button').addEventListener('click', function() {
            teamContainer.classList.toggle('hidden')
        })

        function onClickDetail(nim, nama, fakultas, jurusan) {
            let res = nim + '<br>' + nama + '<br>' + fakultas + '<br>' + jurusan + '<br>'
            teamDetailContainer.innerHTML = res
        }
    </script>
</body>

</html>