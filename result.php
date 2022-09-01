<?php

session_start();
$profilResult = $_SESSION['profilResult'];
array_splice($profilResult, 0, 1);

$result = $_SESSION['result'];
array_splice($result, 0, 1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <span class="text-2xl font-bold"><?= count($profilResult) - 1 ?> Anggota Tim</span>
                        <h1>Profil Tim</h1>
                        <div class="block">
                            <button type="button" id="cta-team-button" class="btn btn-primary">Lihat Profil Anggota</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <span class="text-2xl font-bold"><?= count($result) ?></span>
                        <h1>Kegiatan</h1>
                        <div class="block">
                            <button type="button" id="cta-logbook-button" class="btn btn-primary">Lihat Kegiatan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-5">
            <div id="logbook-container" class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h1 class="font-bold text-2xl inline-block">Kegiatan</h1>
                        <form action="action/print_action.php" method="GET">
                            <input type="hidden" name="type" value="all">
                            <button type="submit" class="btn btn-primary">Print All</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="my-8"></div>
                    <div class="table-responsive">
                        <table class="table table-auto border-collapse border border-slate-400 w-100">
                            <thead>
                                <tr>
                                    <th class="border border-slate-300 px-3 py-1.5">No</th>
                                    <th class="border border-slate-300 px-3 py-1.5">Hari</th>
                                    <th class="border border-slate-300 px-3 py-1.5">Tanggal</th>
                                    <th class="border border-slate-300 px-3 py-1.5">Kegiatan</th>
                                    <th class="border border-slate-300 px-3 py-1.5">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($result)) : ?>
                                    <?php for ($i = 0; $i < count($result); $i++) : ?>
                                        <tr>
                                            <td class="border border-slate-300 px-3 py-1.5"><?= $i + 1 ?></td>
                                            <td class="border border-slate-300 px-3 py-1.5"><?= $result[$i][0] ?></td>
                                            <td class="border border-slate-300 px-3 py-1.5"><?= $result[$i][1] ?></td>
                                            <td class="border border-slate-300 px-3 py-1.5"><?= $result[$i][3] ?></td>
                                            <td class="border border-slate-300 px-3 py-1.5">
                                                <form action="action/print_action.php" method="GET">
                                                    <input type="hidden" name="type" value="single">
                                                    <input type="hidden" name="kegiatan" value="<?= $result[$i][3] ?>">
                                                    <button type="submit" class="btn btn-primary">Print</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endfor ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6">Tidak Ada Data</td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="team-container" class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
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
                                                <td class="px-2 py-1"><?= $i + 1 ?></td>
                                                <td class="px-2 py-1"><?= $profilResult[$i][0] ?></td>
                                                <td class="px-2 py-1"><?= $profilResult[$i][1] ?></td>
                                                <td class="px-2 py-1">
                                                    <button type="button" class="btn btn-primary d-block" onclick="onClickDetail('<?= $profilResult[$i][0] ?>', '<?= $profilResult[$i][1] ?>', '<?= $profilResult[$i][2] ?>', '<?= $profilResult[$i][3] ?>')">Detail</button>
                                                    <form action="action/print_action.php" method="GET">
                                                        <input type="hidden" name="type" value="person">
                                                        <input type="hidden" name="nama" value="<?= $profilResult[$i][1] ?>">
                                                        <button name="single_report_button" type="submit" class="btn btn-primary">Print</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endfor ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                        <div id="team-detail-container" class="col-md-6">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, omnis modi autem placeat voluptatum ducimus, error eius nisi et vitae culpa adipisci quia? Accusantium ipsa obcaecati at quasi accusamus rem!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        const logbookContainer = document.getElementById('logbook-container')
        const teamContainer = document.getElementById('team-container')
        const teamDetailContainer = document.getElementById('team-detail-container')

        logbookContainer.classList.add('d-none')
        teamContainer.classList.add('d-none')

        document.getElementById('cta-logbook-button').addEventListener('click', function() {
            logbookContainer.classList.toggle('d-none')
        })

        document.getElementById('cta-team-button').addEventListener('click', function() {
            teamContainer.classList.toggle('d-none')
        })

        function onClickDetail(nim, nama, fakultas, jurusan) {
            let res = nim + '<br>' + nama + '<br>' + fakultas + '<br>' + jurusan + '<br>'
            teamDetailContainer.innerHTML = res
        }
    </script>
</body>

</html>