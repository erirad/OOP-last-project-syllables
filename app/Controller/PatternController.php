<?php
namespace App\Controller;

use App\Model\Pattern;

class PatternController
{
    private $patterns;

    public function __construct()
    {
        $this->patterns = new Pattern();
    }

    public function insert($fileName)
    {
        $this->patterns->reuploadFileInDatabase($fileName, "\n", "patterns", "name");
    }
}
