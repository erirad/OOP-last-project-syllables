<?php

function addEverySecondCharacterZero($arrOfArr)
{
    $newArrOfArr = array();

    foreach($arrOfArr as $arr){

        $arrWithZero = array();

        foreach($arr as $key => $val){
            if(is_numeric($val) == true){
                array_push($arrWithZero, $val);
            } else if(array_key_exists($key + 1, $arr) == true){
                if(is_numeric($arr[$key + 1]) == true){
                    array_push($arrWithZero, $val);
                } else if(is_numeric($val) == false) {
                    array_push($arrWithZero, $val, '0');
                }
            } else if(is_numeric($val) == false) {
                array_push($arrWithZero, $val, '0');
            }
        }
        array_push($newArrOfArr, $arrWithZero);
    }
    return $newArrOfArr;
}

function setFirstCharToZero($newArrOfArr)
{
    foreach ($newArrOfArr as $key => $value){
        if(!is_numeric($newArrOfArr[$key][0])){
            array_unshift($newArrOfArr[$key],"0");
        }
    }
    return $newArrOfArr;
}

function mergeAllToOneArray($newArrOfArr)
{
    $countCharLenght = count($newArrOfArr[0]);
    $rezultatas = $newArrOfArr[0];

    foreach($newArrOfArr as $arr){

        for($i = 0; $i < $countCharLenght; $i++){

            if(array_key_exists($i, $rezultatas) == false)
                $rezultatas[$i] = null;
            if(array_key_exists($i, $arr) == false)
                $arr[$i] = null;

            if(is_numeric($rezultatas[$i]) == false && is_numeric($arr[$i]) == true)
                $rezultatas[$i] = $arr[$i];
            if(is_numeric($rezultatas[$i]) == true && is_numeric($arr[$i]) == true && $rezultatas[$i] < $arr[$i])
                $rezultatas[$i] = $arr[$i];
        }
    }
    return $rezultatas;
}

function getFinalStringWithNumbers($finalArr) {
//matrica
    $arrOfArr = array();

    foreach ($finalArr as $el){
        array_push($arrOfArr, preg_split('//', $el, -1, PREG_SPLIT_NO_EMPTY));
    }

    $newArrOfArr = addEverySecondCharacterZero($arrOfArr);

    $newArrOfArr = setFirstCharToZero($newArrOfArr);

    $rezultatas = mergeAllToOneArray($newArrOfArr);

    return $rezultatas;
}

$rezultatas = getFinalStringWithNumbers($finalArr);