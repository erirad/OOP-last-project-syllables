<?php
namespace app;

use app\Database;
use app\File;
use app\Input;
use app\Matches;
use app\Syllables;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class App
{
    public function playApp()
    {
        echo "Import patterns file to DB? [Y/N] \n";
        $answerIfImportPatternsToDb = trim(fgets(STDIN, 1024));
        if(strtolower($answerIfImportPatternsToDb) == "y") {
            $db = new Database("test");
            $db->insertIntoDbFromFile("text.txt", "\n", "patterns", "name");
        }

        echo "Import text file to DB? [Y/N] \n";
        $answerIfImportTextToDb = trim(fgets(STDIN, 1024));
        if(strtolower($answerIfImportTextToDb) == "y") {
            $db = new Database("test");
            $db->insertIntoDbFromFile("words.txt", "\n", "words", "word");
        }
        echo "Read all from DB? [Y/N] \n";
        $answerIfSyllablesWithDataFromDb = trim(fgets(STDIN, 1024));
        if(strtolower($answerIfSyllablesWithDataFromDb) == "y") {
            $programStarts = microtime(false);
            $db = new Database("test");
            $fileArray = $db->getDataFromDb("patterns", "name");
            $sentence = $db->getDataFromDb("words", "word");
            $this->checkSentence($sentence, $fileArray, $programStarts);
        } else {
            $programStarts = microtime(false);
            $file = new File();
            $fileArray = $file->storeValuesFromFileIntoArray("text.txt");
            $input = new Input();
            $sentence = $input->storeCustomInputIntoArray();
            $this->checkSentence($sentence, $fileArray, $programStarts);
        }
    }

    public function checkSentence($sentence, $fileArray, $programStarts)
    {
        foreach ($sentence as $word) {

            if (preg_match('~[0-9]~', $word)) {
                echo $word . " ";
                continue;
            }
            $matches = new Matches();
            $matchesArray = $matches->storeAllMatchesIntoArray($fileArray, $word);
            $patternArray = $matches->getMatches();
            foreach ($patternArray as $pattern){
                if(Input::$syllablesword == null) {
                    Database::insertMatchesWithPatternsAndWord($word, $pattern);
                }
            }
            if ($matchesArray != null) {
                $syllables = new Syllables();
                $syllables->storeFinalResult($matchesArray);

                $finalResult = $syllables->getResult();
                if(Input::$syllablesword == null) {
                    Database::updateCmiTableAddFinallResult($word, $finalResult);
                }
                echo $finalResult . " ";
              //  $log = new Logger('name');
               // $log->pushHandler(new StreamHandler('log', Logger::INFO));
              //  $allMatches = $matches->getMatches();
               // $getTime = microtime(false) - $programStarts;
               // $log->info('syllables', array('word' => $word, 'time spent' => $getTime, 'matches:'=> $allMatches));
            } else {
                echo $word . " ";
            }
        }
    }

}

