<?php
namespace App\Helper;

class Syllables
{
    public function getHyphenatedWord($patterns, $input)
    {
        $numbersPositions = $this->getNumbersPositions($patterns, $input);
        $inputWithChanges = $this->findHighestValueAndReplaceOddToDash($numbersPositions, $input);
        if($inputWithChanges){
            return $inputWithChanges;
        } else {
            $result = $this->replaceDots($input);
            return $result;
        }

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
                $onlyOneNumber = $this->replaceNumbersFromWord($pattern, $numbers[$i]);
                $numPosition = strpos($onlyOneNumber, $numbers[$i]);
                $finalPosition = $wordPosition + $numPosition;
                $numbersPositions[$finalPosition][] = $numbers[$i];
            }
        }
        return $numbersPositions;
    }

    private function findHighestValueAndReplaceOddToDash($positionsArray, $input)
    {
        ksort($positionsArray);
        $inputLenght = strlen($input);
        $iterate = 0;
        foreach ($positionsArray as $key => $value) {
            $number = max($value);
            if ($key != 1 && $key != $inputLenght - 1 && $number % 2 != 0){
                $input = substr_replace($input, "-", $key+$iterate, 0);
                $iterate++;
            }
        }
        $input = $this->replaceDots($input);

        return $input;
    }

    private function replaceDots($input)
    {
        $input = preg_replace('/\./', '', $input);

        return $input;
    }

    private function replaceNumbersFromWord($str, $number) {
        $numbersArray = [1,2,3,4,5,6,7,8,9,0];
        $newArray = [];
        foreach ($numbersArray as $singleNumber) {
            if($singleNumber != $number) {
                $newArray[] = $singleNumber;
            }
        }
        $result = str_replace($newArray, '', $str);
        return $result;
    }
}
