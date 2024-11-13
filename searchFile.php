<?php

$searchRoot = 'c:/xampp/htdocs/Work7'; //стартовая директория

$searchName = 'test.txt'; //искомый файл

$searchResult = []; //результаты поиска

$depth = 0;


$folders = [];
function searchFile(string $searchRoot, string $searchName, array &$folders, array &$searchResult, int $depth)
{
    $folders[$depth] = scandir($searchRoot);

    $countFolders = count($folders[$depth]);

    // die('count' . '    ' . $digits);
    for ($k = $countFolders - 1; $k > 1; $k--) {

        // $path1 = sprintf($folders[$depth][$k]);
        // die('files' . '    ' . $files[0][7]);

        $path = $searchRoot . '/' . $folders[$depth][$k];
        // $path = $searchRoot . '/' . $path1;

        if (is_dir($path)) {

            searchFile($path, $searchName, $folders, $searchResult, $depth + 1);

        } else {

            if (strpos($path, "{$searchName}"))
                $searchResult[] = $path;

        }

    }
    return $searchResult;
}

########################

searchFile($searchRoot, $searchName, $folders, $searchResult, 0);

if (empty($searchResult)) {
    echo "Файл $searchName не найден";
} else {
    foreach ($searchResult as $fileResult) {
        echo 'Размер файла ' . $fileResult . ': ' . filesize($fileResult) . ' байт' . PHP_EOL;

    }
}
/*
 {
    foreach ($searchResult as $key => $value) {
        // echo sprintf($value) . PHP_EOL
        $filename = $value;
        if (filesize($filename) > 0) {
            echo 'Размер файла ' . $filename . ': ' . filesize($filename) . ' байт' . PHP_EOL;
        }

    }
} else {
    echo 'Файлы не найдены!' . PHP_EOL;
}
echo 'End' . PHP_EOL;
*/