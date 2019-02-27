<?php
namespace App\Controller;
use App\Lib\Match;
use App\Lib\PatternsTree;
use App\Start\App;
use App\Controller\PatternController;
use App\Controller\WordController;
use App\Controller\InputController;
use App\Helper\File;
use App\Controller\LoggerController;

class Navigation
{
    private $run = true;
    private $patterns;
    private $words;
    private $patternTree;
    private $file;
    private $app;
    private $customInput;
    private $logger;

    public function __construct()
    {
        $this->patterns = new PatternController();
        $this->words = new WordController();
        $tree = new PatternsTree();
        $this->patternTree = $tree->makePatternsTree();
        $this->file = new File();
        $this->app = new App();
        $this->customInput = new InputController();
        $this->logger = new LoggerController();
    }

    public function menu()
    {
        while($this->run == true){
            echo "\n1. Import file to DB \n";
            echo "2. Write your sentence \n";
            echo "3. Exit \n";
            echo "Your choice: ";

            $menuAnswer = trim(fgets(STDIN, 1024));

            switch ($menuAnswer) {
                case 1:
                    while($this->run == true){
                        echo "\n1. Import patters file \n";
                        echo "2. Import text file \n";
                        echo "3. Exit \n";
                        echo "Your choice: ";

                        $subMenuAnswer = trim(fgets(STDIN, 1024));
                        $this->subMenuImport($subMenuAnswer);
                    }
                    break;
                case 2:
                    while($this->run == true){
                        echo "\n1. Write sentence \n";
                        echo "2. Read from text file \n";
                        echo "3. Exit \n";
                        echo "Your choice: ";

                        $subMenuAnswer = trim(fgets(STDIN, 1024));
                        $this->subMenuInput($subMenuAnswer);
                    }
                    break;
                case 3:
                    echo "\n exit \n";
                    $this->run = false;
                default:
                    $this->run = false;
            }
        }
    }

    private function subMenuImport($subMenuAnswer)
    {
        switch ($subMenuAnswer) {
            case 1:
                $this->patterns->insert("text.txt");
                break;
            case 2:
                $this->words->insert("words.txt");
                break;
            case 3:
                $this->menu();
                break;
            default:
                echo "Pick one of menu point";
        }
    }

    private function subMenuInput($subMenuAnswer)
    {
        switch ($subMenuAnswer) {
            case 1:
                $input = trim(fgets(STDIN, 1024));
                $sentence = preg_split("/[\s]+/", $input);
                $this->subMenuSource($sentence);
                break;
            case 2:
                echo "file name: ";
                $fileName = trim(fgets(STDIN, 1024));
                $sentence = $this->file->insertValuesFromFileIntoArray($fileName);
                $this->subMenuSource($sentence);
                break;
            case 3:
                $this->menu();
                break;
            default:
                echo "Pick one of menu point";
        }
    }

    private function subMenuSource($sentence)
    {
        echo "\n1. Source from DB\n";
        echo "2. Source from file\n";
        echo "3. Exit \n";
        echo "Your choice: ";

        $subMenuAnswer = trim(fgets(STDIN, 1024));
        switch ($subMenuAnswer){
            case 1:
                foreach ($sentence as $word){
                    $result = $this->app->hyphenateInput($word, $this->patternTree);
                    $this->customInput->insertWord($word, $result);
                    echo $result . " ";
                }
                break;
            case 2:
                $start = microtime(true);
                foreach ($sentence as $word){
                    $result = $this->app->hyphenateInput($word, $this->patternTree);
                    echo $result . " ";
                }
                $this->logger->infoLogger($start);
                break;
            case 3:
                $this->menu();
                break;
            default:
                echo "Pick one of menu point";
        }
    }
}