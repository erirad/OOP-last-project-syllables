<?php
namespace App\Start;

use App\Lib\Match;
use App\Lib\Hyphenator;

class App
{
    private $matches;
    private $syllables;

    public function __construct()
    {
        $this->matches = new Match();
        $this->syllables = new Hyphenator();
    }

    public function hyphenateInput($input, $patternTree)
    {
      $inputWithDots = $this->addDotsBeforeAndAfterWord($input);
      $patterns = $this->matches->getPatterns($inputWithDots, $patternTree);
      if($patterns){
          $result = $this->syllables->getHyphenatedWord($patterns, $inputWithDots);

          return $result;
      } else {
          return $input;
      }
    }

    private function addDotsBeforeAndAfterWord($input)
    {
        $inputLength = strlen($input);
        $inputWithDot = substr_replace($input, '.', 0, 0);
        $inputWithDots = substr_replace($inputWithDot, '.', $inputLength + 1, 0);

        return $inputWithDots;
    }
}

