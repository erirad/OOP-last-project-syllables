<?php
namespace App\Helper;

use App\Helper\File;

class Match
{
    private $matches = [];

    private function getMatch($pattern, $inputWithDots)
    {
        $patternWithoutNumbers = preg_replace('/[0-9]+/', '', $pattern);
        $match = strpos($inputWithDots, $patternWithoutNumbers);
        if (is_numeric($match)) {
            $this->matches[] = $pattern;
        }
    }

    public function insertMatchesIntoArray($inputWithDots)
    {
        $file = new File();
        $patterns = $file->insertValuesFromFileIntoArray("/var/www/html/untitled/text.txt");

        foreach ($patterns as $pattern)
        {
            $this->getMatch($pattern, $inputWithDots);
        }
        return $this->matches;
    }
}