<?php
namespace App\Controller;

use App\Model\Word;

class WordController
{
    public function insert($fileName)
    {
        $words = new Word();
        $words->reuploadFileInDatabase($fileName, "\n", "words", "word");
    }

    public function read()
    {
        $words = new Word();
        $data = $words->getDataFromDb("words", "word");

        return $data;
    }


}