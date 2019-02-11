<?php

class File
{
    private $valuesFromFile = [];

    public function getFileArray()
    {
      return $this->valuesFromFile;
    }

    public function storeValuesFromFileIntoArray($fileName)
    {
        $file = new SplFileObject($fileName);

        while (!$file->eof()) {
            $line = trim($file->fgets());
            $this->valuesFromFile[] = $line;
        }
    }
}
?>
