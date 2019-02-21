<?php
namespace App\Helper;

class Syllables
{
    private function myFunction($str, $number) {
        $numbersArray = [1,2,3,4,5,6,7,8,9,0];
        $newArray = [];
        foreach ($numbersArray as $singleNumber) {
            if($singleNumber != $number) {
                $newArray[] = $singleNumber;
            }
        }
        $rez = str_replace($newArray, '', $str);
        return $rez;
    }

    private function getNumbersPositions($patterns, $input)
    {
        foreach ($patterns as $pattern){
            $withoutNumber = preg_replace('/[0-9]+/', '', $pattern);
            $numbersWithDot = preg_replace('/[a-z]+/', '', $pattern);
            $numbers = preg_replace('/\./', '', $numbersWithDot);
            $numLenght = strlen($numbers);
            $wordPosition = strpos($input, $withoutNumber);
            for($i=0; $i<$numLenght; $i++){
                $onlyOneNumber = $this->myFunction($pattern, $numbers[$i]);
                $numPosition = strpos($onlyOneNumber, $numbers[$i]);
                $finalPosition = $wordPosition + $numPosition;
                $numbersPositions[$finalPosition][] = $numbers[$i];
            }
        }
        return $numbersPositions;
    }

    private function findHighestValueAndReplaceOddToDash($positionsArray, $input)
    {
        $numberPosition = "";
        print_r($numberPosition);
        $inputLenght = strlen($input);
        foreach ($positionsArray as $key => $value) {
            $number = max($value);
            if ($key != 1 && $key != $inputLenght - 1 && $number % 2 != 0){
                $numberPosition[$key] = "-";
            }
        }
        return $numberPosition;
    }

    private function replaceDots($input)
    {
        $input = preg_replace('/\./', '', $input);

        return $input;
    }

    private function addDashesToInputAndReplaceDots($finalPositions, $input)
    {
        $iterate = 0;
        ksort($finalPositions);
        foreach ($finalPositions as $key => $value){
            $input = substr_replace($input, $value, $key+$iterate, 0);
            $iterate++;
        }
        $input = $this->replaceDots($input);

        return $input;
    }

    public function getSyllablesWord($patterns, $input)
    {
        $numbersPositions = $this->getNumbersPositions($patterns, $input);
        $numberPosition = $this->findHighestValueAndReplaceOddToDash($numbersPositions, $input);
        if($numberPosition){
            $result = $this->addDashesToInputAndReplaceDots($numberPosition, $input);
            return $result;
        } else {
            $result = $this->replaceDots($input);
            return $result;
        }

    }
}