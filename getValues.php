<?php

echo "Irasykite zodi: ";

$inputValue = trim(fgets(STDIN, 1024));


//$sentenceArr = array();
//$sentenceArr = preg_split("/[\s,]+/", $inputValue,-1, PREG_SPLIT_NO_EMPTY);

function getStartMatch($value, $inputValue, $lenght, $withoutNumber)
{
    if (substr($withoutNumber, 0, 1) === '.') {
        $valuewithoutdot = substr($withoutNumber, 1);
        $partOfValue = substr($inputValue, 0, $lenght);
        if ($partOfValue === $valuewithoutdot) {
            $replaced = preg_replace('/' . $partOfValue . '/', $value, $inputValue);
            $replaced = substr($replaced, 1);
            return $replaced;
        }
    }
}
function getEndMatch($value, $inputValue, $lenght, $withoutNumber)
{
    if (substr($withoutNumber, $lenght, 1) === '.') {
        $valuewithoutdot = substr($withoutNumber, 0, -1);
        $partOfValue = substr($inputValue, -$lenght);
        $match = substr($inputValue, -$lenght) === $valuewithoutdot;
        if ($partOfValue === $valuewithoutdot) {
            $replaced = preg_replace('/' . $partOfValue . '/', $value, $inputValue);
            $replaced = substr($replaced, 0, -1);
            return $replaced;
        }
    }
}

function getMiddleMatch($value, $inputValue, $lenght, $withoutNumber)
{
    $elementFrom = stripos($inputValue, $withoutNumber);
    $partOfValue = substr($inputValue, $elementFrom, $lenght + 1);
    if ($elementFrom !== false) {
        $replaced = preg_replace('/' . $partOfValue . '/', $value, $inputValue);
        return $replaced;
    }
}

function getAllMatches($valuesFromText, $inputValue)
{
    $finalArr = array();
    foreach ($valuesFromText as $value) {

        $withoutNumber = preg_replace('/[0-9]+/', '', $value);
        $lenght = strlen($withoutNumber) - 1;

        $getStartMatch = getStartMatch($value, $inputValue, $lenght, $withoutNumber);
        if($getStartMatch != ""){
            array_push($finalArr, $getStartMatch);
        }
        $getMiddleMatch = getMiddleMatch($value, $inputValue, $lenght, $withoutNumber);
        if($getMiddleMatch != ""){
            array_push($finalArr, $getMiddleMatch);
        }
        $getEndMatch = getEndMatch($value, $inputValue, $lenght, $withoutNumber);
        if($getEndMatch != ""){
            array_push($finalArr, $getEndMatch);
        }
    }
    return $finalArr;
}

$finalArr = getAllMatches($arr, $inputValue);


