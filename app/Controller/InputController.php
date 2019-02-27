<?php
namespace App\Controller;

use App\Model\Input;

class InputController
{
    private $input = null;

    public function __construct()
    {
        $this->input = new Input();
    }

    public function insertWord($word, $result)
    {
        $this->input->insertInputWithHyphenatedResultToDB($word, $result);
    }

    public function insertPatterns($word, $pattern)
    {
        $this->input->insertMatchesWithPatternsAndWord($word, $pattern);
    }
}