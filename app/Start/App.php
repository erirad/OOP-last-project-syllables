<?php
namespace App;


use App\Helper\Match;
use App\Helper\Syllables;
use App\Monolog\Logger;
use App\Monolog\Handler\StreamHandler;

class App
{
    private $matches;
    private $syllables;

    public function __construct()
    {
        $this->matches = new Match();
        $this->syllables = new Syllables();
    }

    private function addDotsBeforeAndAfterWord($input)
    {
        $inputLength = strlen($input);
        $inputWithDot = substr_replace($input, '.', 0, 0);
        $inputWithDots = substr_replace($inputWithDot, '.', $inputLength + 1, 0);

        return $inputWithDots;
    }

  public function syllableInput($input)
  {
      $inputWithDots = $this->addDotsBeforeAndAfterWord($input);
      $patterns = $this->matches->insertMatchesIntoArray($inputWithDots);
      if($patterns){
          $result = $this->syllables->getSyllablesWord($patterns, $inputWithDots);

          return $result;
      } else {
          return $input;
      }
  }
}

