<?php
namespace App\Helper;

class File
{
    public function insertValuesFromFileIntoArray($fileName)
    {
        $file = new \SplFileObject($fileName);

        while (!$file->eof()) {
            $line = trim($file->fgets());
            $valuesFromFile[] = $line;
        }
        return $valuesFromFile;
    }

    public function storeValuesFromFileIntoString($fileName)
    {
        $file = new \SplFileObject($fileName);

        while (!$file->eof()) {
            $line = trim($file->fgets());
            $valuesFromFile = $line;
        }
        return $valuesFromFile;
    }
}
?>
