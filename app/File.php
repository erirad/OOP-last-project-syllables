<?php
namespace app;

class File
{
    public function storeValuesFromFileIntoArray($fileName)
    {
        $file = new \SplFileObject($fileName);

        while (!$file->eof()) {
            $line = trim($file->fgets());
            $valuesFromFile[] = $line;
        }
        return $valuesFromFile;
    }
}
?>
