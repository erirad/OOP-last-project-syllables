<?php
namespace app;

use app\Matches;
use app\Syllables;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;



class App
{
    public function playApp($fileName)
    {
        echo "Read from file? [Y/N] \n";
        $answerIfReadFromFile = trim(fgets(STDIN, 1024));
        if($answerIfReadFromFile == "Y") {
            echo "file name: ";
            $file = trim(fgets(STDIN, 1024));
            $sentence = file_get_contents(PATH."/$file");
            $sentence = preg_split("/[\s]+/", $sentence);
        } else {
            echo "Irasykite zodi: \n";
            $input = trim(fgets(STDIN, 1024));
            $sentence = preg_split("/[\s]+/", $input);
        }
        foreach ($sentence as $word) {
            $programStarts = microtime(false);
            if (preg_match('~[0-9]~', $word)){
                echo $word . " ";
                continue;
            }
            $matches = new Matches();
            $finalArr = $matches->storeAllMatchesIntoArray($fileName, $word);
            if($finalArr != null) {
                $syllables = new Syllables();
                $syllables->getFinalStringWithNumbers($finalArr);
                $syllables->printFinalResult();

                $log = new Logger('name');
                $log->pushHandler(new StreamHandler('log', Logger::INFO));
                $getTime = microtime(false) - $programStarts;
                $allMatches = $matches->getMatches();
                $log->info('syllables', array('word' => $word, 'time spent' => $getTime, 'matches:'=> $allMatches));
            } else {
                echo $word . " ";
            }
        }
    }
}

