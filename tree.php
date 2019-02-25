<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Helper\File;


$file = new File();
$patterns = $file->insertValuesFromFileIntoArray("/var/www/html/untitled/text.txt");

$sortedByTwoArr = [];
$patternsWithoutNumbersArray = [];
foreach ($patterns as $pattern){
    $patternWithoutNumbers = preg_replace('/[0-9]+/', '', $pattern);
    $patternsWithoutNumbersArray[] = $patternWithoutNumbers;
    $sortedByTwoArr[$patternWithoutNumbers[0]][$patternWithoutNumbers[1]][] = $pattern;
}
//print_r($patternsWithoutNumbersArray);




$wordArr = [];
$word = ".mistranslate.";
$lenght = strlen($word);
for($i=0; $i<$lenght-1; $i++){
    $one = $word[$i];
    $two = $word[$i+1];
    $wordArr[$one][$two] = $one . $two;
}
//print_r($wordArr);

$finalArr = [];
foreach ($wordArr as $first => $item) {
   foreach ($item as $second => $value){
       foreach ($sortedByTwoArr[$first][$second] as $fin)
       $finalArr[] = $fin;

   }
}



    print_r($finalArr);
