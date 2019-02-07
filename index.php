<?php
$file = new SplFileObject("text.txt");
$arr = array();
while (!$file->eof()) {
    $line = trim($file->fgets());
    array_push($arr, $line);
}

include 'getValues.php';
include 'syllables.php';



function printFinalResult($rezultatas)
{
// gauname rezultata, pasaliname nebereikalingus '0', atspausdiname kaip string
    $rezultatas = str_replace ( "0","", $rezultatas );

//pakeicia nelyginius - "-", lyginius- ""
    foreach ($rezultatas as $key => $rez) {
        if(is_numeric($rez) && $rez % 2 != 0) {
            $rezultatas[$key] = "-";
        }
        if(is_numeric($rez) && $rez % 2 == 0) {
            $rezultatas[$key] = "";
        }
        if($rezultatas[0] == "-") {
            $rezultatas[$key] = "";
        }
    }

    $rezultatas = implode("", $rezultatas);

    return $rezultatas;

}

$rezultatas = printFinalResult($rezultatas);
echo $rezultatas . "\n";
