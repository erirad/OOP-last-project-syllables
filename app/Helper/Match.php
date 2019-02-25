<?php
namespace App\Helper;

use App\Helper\PatternsTree;

class Match
{
    private $patternTree;

    public function __construct()
    {
        $this->patternTree = new PatternsTree();
    }

    private function getMatch($patterns, $inputWithDots)
    {
        $matches = [];
        foreach ($patterns as $pattern){
            $patternWithoutNumbers = preg_replace('/[0-9]+/', '', $pattern);
            $match = strpos($inputWithDots, $patternWithoutNumbers);
            if (is_numeric($match)) {
                $matches[] = $pattern;
            }
        }
        return $matches;
    }

    public function getPatterns($inputWithDots)
    {
        $sortedByTwoArr = $this->patternTree->makePatternsTree();
        $wordArr = [];
        $lenght = strlen($inputWithDots);
        for($i=0; $i<$lenght-1; $i++){
            $char = $inputWithDots[$i];
            $secondChar = $inputWithDots[$i+1];
            $wordArr[$char][$secondChar] = $char . $secondChar;
        }

        $finalArr = [];
        foreach ($wordArr as $first => $item) {
            foreach ($item as $second => $value){
                if(array_key_exists($second, $sortedByTwoArr[$first])) {
                    foreach ($sortedByTwoArr[$first][$second] as $fin){
                        $finalArr[] = $fin;
                    }
                }
            }
        }
        return $finalArr;
    }

    public function insertMatchesIntoArray($inputWithDots)
    {
        $patterns = $this->getPatterns($inputWithDots);
        $matches = $this->getMatch($patterns, $inputWithDots);

        return $matches;
    }
}
