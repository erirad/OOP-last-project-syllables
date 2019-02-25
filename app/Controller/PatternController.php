<?php
namespace App\Controller;

use App\Model\Pattern;

class PatternController
{
    public function insert($fileName)
    {
        $patterns = new Pattern();
        $patterns->reuploadFileInDatabase($fileName, "\n", "patterns", "name");
    }

    public function read()
    {
        $patterns = new Pattern();
        $data = $patterns->getDataFromDb("patterns", "name");

        return $data;
    }
}
