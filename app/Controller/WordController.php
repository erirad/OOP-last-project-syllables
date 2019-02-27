<?php
namespace App\Controller;

use App\Model\Word;

class WordController
{
    private $words;

    public function __construct()
    {
        $this->words = new Word();
    }

    public function insert($fileName)
    {
        $this->words->reuploadFileInDatabase($fileName, "\n", "words", "word");
    }
}