<?php
namespace app;

use app\File;

class Matches
{
    private $input;

    private $matches = [];

    public function getMatches() {
        return $this->matches;
    }

    private function getStartMatch($value, $lenght, $withoutNumber)
    {
        if (substr($withoutNumber, 0, 1) === '.') {
            $valuewithoutdot = substr($withoutNumber, 1);
            $partOfValue = substr($this->input, 0, $lenght);
            if ($partOfValue === $valuewithoutdot) {
                $replaced = preg_replace('/' . $partOfValue . '/', $value, $this->input);
                $replaced = substr($replaced, 1);
                $this->matches[] = $value;
                return $replaced;
            }
        }
    }

    private function getMiddleMatch($value, $lenght, $withoutNumber)
    {
        $elementFrom = stripos($this->input, $withoutNumber);
        $partOfValue = substr($this->input, $elementFrom, $lenght + 1);
        if ($elementFrom !== false) {
            $replaced = preg_replace('/' . $partOfValue . '/', $value, $this->input);
            $this->matches[] = $value;
            return $replaced;
        }
    }

    private function getEndMatch($value, $lenght, $withoutNumber)
    {
        if (substr($withoutNumber, $lenght, 1) === '.') {
            $valuewithoutdot = substr($withoutNumber, 0, -1);
            $partOfValue = substr($this->input, -$lenght);
            $match = substr($this->input, -$lenght) === $valuewithoutdot;
            if ($partOfValue === $valuewithoutdot) {
                $replaced = preg_replace('/' . $partOfValue . '/', $value, $this->input);
                $replaced = substr($replaced, 0, -1);
                $this->matches[] = $value;
                return $replaced;
            }
        }
    }

    public function storeAllMatchesIntoArray($fileName, $input)
    {
        $file = new File();
        $fileArray = $file->storeValuesFromFileIntoArray($fileName);

        $finalArr = [];
        $this->input = $input;

        foreach ($fileArray as $value) {
            $withoutNumber = preg_replace('/[0-9]+/', '', $value);
            $lenght = strlen($withoutNumber) - 1;
            $getStartMatch = $this->getStartMatch($value, $lenght, $withoutNumber);
            if($getStartMatch != ""){
                $finalArr[] = $getStartMatch;
            }
            $getMiddleMatch = $this->getMiddleMatch($value, $lenght, $withoutNumber);
            if($getMiddleMatch != ""){
                $finalArr[] = $getMiddleMatch;
            }
            $getEndMatch = $this->getEndMatch($value, $lenght, $withoutNumber);
            if($getEndMatch != ""){
                $finalArr[] = $getEndMatch;
            }
        }
        return $finalArr;
    }
}
?>