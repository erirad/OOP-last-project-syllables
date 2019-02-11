<?php
class PlayApp
{
    public function __construct($fileName)
    {
        echo "Irasykite zodi: ";
        $input = trim(fgets(STDIN, 1024));
        $programStarts = microtime(false);
        $matches = new Matches();
        $matches->storeAllMatchesIntoArray($fileName, $input);
        $finalArr = $matches->getfinalArr();

        $syllables = new Syllables();
        $syllables->getFinalStringWithNumbers($finalArr);
        $syllables->printFinalResult();
        $getTime = microtime(false) - $programStarts;
    }
}