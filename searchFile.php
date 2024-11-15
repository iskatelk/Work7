<?php

function searchFile(string $searchRoot, string $searchName, array &$searchResult)
{
    $folders = scandir($searchRoot);

    $countFolders = count($folders);

    for ($k = $countFolders - 1; $k > 1; $k--) {

        $path = $searchRoot . '/' . $folders[$k];

        if (is_dir($path)) {

            searchFile($path, $searchName, $searchResult);

        } else {

            if (strpos($path, "{$searchName}"))
                $searchResult[] = $path;
        }
    }
    return $searchResult;
}

$searchRoot = 'c:/xampp/htdocs/Work7'; //стартовая директория

$searchName = 'test.txt'; //искомый файл

$searchResult = []; //результаты поиска

$depth = 0;


$folders = [];

########################

searchFile($searchRoot, $searchName, $searchResult);

if (!empty($searchResult)) {
    echo "Файл $searchName найден в директориях:" . PHP_EOL;

    foreach ($searchResult as $fileResult) {
        echo "\t" . $fileResult . ", размер файла : " . filesize($fileResult) . " байт" . PHP_EOL;
    }
} else {
    echo "Файл $searchName не найден";
}

$nonEmptyFile = array_filter($searchResult, "filesize");

if (!empty($nonEmptyFile)) {
    echo "Найдены непустые файлы:" . PHP_EOL;
    foreach ($nonEmptyFile as $fileName) {
        echo "\t" . $fileName . ", размер файла : " . filesize($fileName) . " байт" . PHP_EOL;
    }
} else {
    echo "Непустые файлы не найдены";
}