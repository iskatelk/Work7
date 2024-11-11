<?php

echo 'Privet';

$searchRoot = 'z:/usr'; //стартовая директория

$searchName = 'README.txt'; //искомый файл

$searchResult  = []; //результаты поиска


$files1 = [];
function searchFile (string $searchRoot,string $searchName,&$searchResult)
{
    $searchResult = scandir($searchRoot);
   // var_dump($searchResult);
    $digits = count($searchResult);
    for ($k = $digits - 1; $k > 1; $k--) {

        $str1 = sprintf($searchResult[$k]);

        $str2 = $searchRoot . '/' . $str1;
        //  die($searchResult . '    ' . $str2);
        if (is_dir($str2)) {

            searchFile($str2, $searchName, $searchResult[$k]);

        } elseif (strpos($str2, "{$searchName}")) {

            // if (strpos($str2, "{$searchName}")) {
            echo $str2 . PHP_EOL;
            // }

        }
    }
        $result = in_array("{$searchName}",$searchResult);

          if($result) {
                echo 'Файлы не найдены'.PHP_EOL;
        }

}

searchFile($searchRoot,$searchName,$searchResult);
