<?php

session_start();

function csvToArray($csvFile)
{
    $file = fopen($csvFile, 'r');
    $lines = [];

    while (!feof($file)) {
        $lines[] = fgetcsv($file, 1000, ',');
    }

    fclose($file);

    return $lines;
}

if (isset($_POST['submit-form'])) {
    $profil = $_FILES['profil']['tmp_name'];
    $profilResult = csvToArray($profil);
    $_SESSION['profilResult'] = $profilResult;

    $kegiatan = $_FILES['kegiatan']['tmp_name'];
    $result = csvToArray($kegiatan);
    $_SESSION['result'] = $result;

    header('location:result.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5 w-50">
        <form method="POST" name="upload-form" enctype="multipart/form-data" class="card">
            <div class="card-header">
                <h1 class="font-bold text-2xl">Info</h1>
                <p>Upload data KKN dengan <a href="" class="text-blue-400 hover:text-blue-600">template berikut</a></p>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <span class="block">Profil</span>
                    <input accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" type="file" name="profil" id="csv" class="form-control">
                </div>
                <div class="mb-2">
                    <span class="block">Document</span>
                    <input accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" type="file" name="kegiatan" id="csv" class="form-control">
                </div>
                <div class="d-grid gap-2 justify-content-end">
                    <button type="submit" name="submit-form" class="btn btn-primary">
                        Upload
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>