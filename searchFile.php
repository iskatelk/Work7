<?php

$searchRoot = 'c:/xampp/htdocs/Work7'; //стартовая директория

$searchName = 'test.txt'; //искомый файл

$searchResult = []; //результаты поиска


$files = [];
function searchFile(string $searchRoot, string $searchName, array &$files, array &$searchResult, int $m)
{
    $files[$m] = scandir($searchRoot);

    $digits = count($files[$m]);
    for ($k = $digits - 1; $k > 1; $k--) {

        $str1 = sprintf($files[$m][$k]);
        //die($files1.'    '.$files1[0][2]);

        $str2 = $searchRoot . '/' . $str1;

        if (is_dir($str2)) {

            searchFile($str2, $searchName, $files, $searchResult, $m + 1);

        } else {

            if (strpos($str2, "{$searchName}"))
                $searchResult[] = $str2;
            //    echo $str2 . PHP_EOL;
        }


        if ($m == 0 && $k == 2) {
            if (array_key_exists("0", $searchResult)) {
                foreach ($searchResult as $key => $value) {
                    // echo sprintf($value) . PHP_EOL
                    $filename = sprintf($value);
                    if (filesize($filename) > 0) {
                        echo 'Размер файла ' . $filename . ': ' . filesize($filename) . ' байт' . PHP_EOL;
                    }

                }
            } else {
                echo 'Файлы не найдены!' . PHP_EOL;
            }
            echo 'Konec' . PHP_EOL;

        }
    }
}


searchFile($searchRoot, $searchName, $files, $searchResult, 0);