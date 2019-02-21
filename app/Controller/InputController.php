<?php
namespace App\Controller;

use App\Model\Input;

class InputController
{
    private $input;

    public function __construct()
    {
        $this->input = new Input();
    }

    public function insert($word, $result)
    {
        $this->input->insertWordsFromCmiIntoTableWithResult($word, $result);
    }
}