<?php
namespace App\Controller;
use App\Start\App;
use App\Controller\PatternController;
use App\Controller\WordController;
use App\Controller\InputController;
use App\Helper\File;

class Navigation
{
    private $run = true;
    private $patterns;
    private $words;

    public function __construct()
    {
        $this->patterns = new PatternController();
        $this->words = new WordController();
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
                        echo "3. Read all files from DB \n";
                        echo "4. Exit \n";
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
            } //switch
        } // while
    } //function menu

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
                //$programStarts = microtime(false);
                $patternsArray = $this->patterns->read();
                $wordsArray = $this->words->read();
                $new = new App();
                foreach ($wordsArray as $word){
                    $result = $new->syllableInput($word[0]);
                    echo $result . " ";
                }
                break;
            case 4:
                $this->menu();
                break;
            default:
                echo "Pick one of menu point";
        } //switch
    }//subfunction


    private function subMenuInput($subMenuAnswer)
    {
        switch ($subMenuAnswer) {
            case 1:
                $input = trim(fgets(STDIN, 1024));
                $sentence = preg_split("/[\s]+/", $input);
                $programStarts = microtime(false);
                $this->subMenuSource($sentence, $programStarts);
                break;
            case 2:
                echo "file name: ";
                $fileName = trim(fgets(STDIN, 1024));
                $file = new File();
                $sentence = $file->insertValuesFromFileIntoArray($fileName);
                $programStarts = microtime(false);
                $this->subMenuSource($sentence, $programStarts);
                break;
            case 3:
                $this->menu();
                break;
            default:
                echo "Pick one of menu point";
        } //switch
    }//subfunction

    private function subMenuSource($sentence, $programStarts)
    {
        echo "\n1. Source from DB\n";
        echo "2. Source from file\n";
        echo "3. Exit \n";
        echo "Your choice: ";
        $subMenuAnswer = trim(fgets(STDIN, 1024));
        switch ($subMenuAnswer){
            case 1:
                $fileArray = $this->patterns->read();
                $customInput = new InputController();
                $new = new App();
                foreach ($sentence as $word){
                    $result = $new->syllableInput($word);
                    $customInput->insert($word, $result);
                    echo $result . " ";
                }
                break;
            case 2:
                $file = new File();
                $fileArray = $file->insertValuesFromFileIntoArray("text.txt");
                $new = new App();
                foreach ($sentence as $word){
                    $result = $new->syllableInput($word);
                  //  echo $result . " ";
                }
                break;
            case 3:
                $this->menu();
                break;
            default:
                echo "Pick one of menu point";
        }
    }
} //class