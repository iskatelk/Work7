<?php

$searchRoot = 'c:/xampp/htdocs/Work7'; //стартовая директория

$searchName = 'test1.txt'; //искомый файл

$searchResult = [0, 1, 2]; //результаты поиска

$m = 0;


$elements = [];
function searchFile(string $searchRoot, string $searchName, array &$elements, array &$searchResult, int $m)
{
    $elements[$m] = scandir($searchRoot);

    $count_elements = count($elements[$m]);
    // die('count' . '    ' . $digits);
    for ($k = $count_elements - 1; $k > 1; $k--) {

        $str1 = sprintf($elements[$m][$k]);
        // die('files' . '    ' . $files[0][7]);

        $str2 = $searchRoot . '/' . $str1;

        if (is_dir($str2)) {

            searchFile($str2, $searchName, $elements, $searchResult, $m + 1);

        } else if (strpos($str2, "{$searchName}")) {

            if ($searchResult[$m] != $str2) {
                $searchResult[$m] = $str2;
                echo sprintf($searchResult[$m]) . PHP_EOL;
                $filename = sprintf($searchResult[$m]);
                if (filesize($filename) > 0) {
                    echo 'Размер файла ' . $filename . ': ' . filesize($filename) . ' байт' . PHP_EOL;
                }
            }
        } else {
            if ($m == 2 && $k == 2) {
                echo 'Файлы не найдены!' . PHP_EOL;
            }
        }

    }
}


searchFile($searchRoot, $searchName, $elements, $searchResult, 0);