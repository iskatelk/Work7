<?php

$searchRoot = 'c:/xampp/htdocs/Work7'; //стартовая директория

$searchName = 'test.txt'; //искомый файл

$searchResult = [0, 1, 2]; //результаты поиска

$depth = 0;


$folders = [];
function searchFile(string $searchRoot, string $searchName, array &$folders, array &$searchResult, int $depth)
{
    $folders[$depth] = scandir($searchRoot);

    $countFolders = count($folders[$depth]);

    // die('count' . '    ' . $digits);
    for ($k = $countFolders - 1; $k > 1; $k--) {

        $path1 = sprintf($folders[$depth][$k]);
        // die('files' . '    ' . $files[0][7]);

        $path2 = $searchRoot . '/' . $path1;

        if (is_dir($path2)) {

            searchFile($path2, $searchName, $folders, $searchResult, $depth + 1);

        } else if (strpos($path2, "{$searchName}")) {

            if ($searchResult[$depth] != $path2) {
                $searchResult[$depth] = $path2;
                echo sprintf($searchResult[$depth]) . PHP_EOL;
                $filename = sprintf($searchResult[$depth]);
                if (filesize($filename) > 0) {
                    echo 'Размер файла ' . $filename . ': ' . filesize($filename) . ' байт' . PHP_EOL;
                }
            }
            // $flag++;
        } else {
            /*   if ($flag == 0) {
                   echo 'Файлы не найдены!' . PHP_EOL;
               }*/
        }

    }
}


searchFile($searchRoot, $searchName, $folders, $searchResult, 0);