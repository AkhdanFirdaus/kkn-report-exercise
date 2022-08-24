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
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <form method="POST" name="upload-form" enctype="multipart/form-data">
        <div class="flex h-screen">
            <div class="m-auto flex flex-col space-y-3">
                <div class="bg-slate-200 px-8 py-6">
                    <h1 class="font-bold text-2xl">Info</h1>
                    <p>Upload data KKN dengan <a href="" class="text-blue-400 hover:text-blue-600">template berikut</a></p>

                </div>
                <div class="bg-slate-300 px-8 py-6">
                    <div class="flex flex-col space-y-4">
                        <div class="flex flex-col space-y-2">
                            <span class="block">Profil</span>
                            <input accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" type="file" name="profil" id="csv" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 rounded bg-slate-50 px-3 py-2">
                        </div>
                        <div class="flex flex-col space-y-2">
                            <span class="block">Document</span>
                            <input accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" type="file" name="kegiatan" id="csv" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 rounded bg-slate-50 px-3 py-2">
                        </div>
                        <div class="flex justify-end w-100">
                            <button type="submit" name="submit-form" class="bg-sky-600 text-white px-3 py-1.5 hover:bg-sky-700 rounded">
                                Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>