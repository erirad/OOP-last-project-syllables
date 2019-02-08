<?php

class File {
  private $file;
  protected $arr = array();
  protected $input;
  
  function __construct($file) {
    $this->file = new SplFileObject($file);
    $this->getValuesFromUploadFile();
  }

  private function getValuesFromUploadFile()
  {
    while (!$this->file->eof()) {
        $line = trim($this->file->fgets());
        array_push($this->arr, $line);
    }
    echo "Irasykite zodi: ";
    $this->input = trim(fgets(STDIN, 1024));
  }

}
