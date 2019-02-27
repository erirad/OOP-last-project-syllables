<?php
namespace App\Helper;

use App\Helper\File;

class PatternsTree
{
    private $file;

    public function __construct()
    {
        $this->file = new File();
    }

    public function makePatternsTree()
    {
        $patterns = $this->file->insertValuesFromFileIntoArray("/var/www/html/untitled/text.txt");

        $sortedByTwoArr = [];
        foreach ($patterns as $pattern) {
            $patternWithoutNumbers = preg_replace('/[0-9]+/', '', $pattern);
            $length = strlen($patternWithoutNumbers);
            if($length < 3){
                $sortedByTwoArr[$patternWithoutNumbers[0]][$patternWithoutNumbers[1]][0][] = $pattern;
            } else {
                $sortedByTwoArr[$patternWithoutNumbers[0]][$patternWithoutNumbers[1]][$patternWithoutNumbers[2]][] = $pattern;
            }
        }
        return $sortedByTwoArr;
    }
}