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
        $patternsWithoutNumbersArray = [];
        foreach ($patterns as $pattern) {
            $patternWithoutNumbers = preg_replace('/[0-9]+/', '', $pattern);
            $patternsWithoutNumbersArray[] = $patternWithoutNumbers;
            $sortedByTwoArr[$patternWithoutNumbers[0]][$patternWithoutNumbers[1]][] = $pattern;
        }
        return $sortedByTwoArr;
    }
}