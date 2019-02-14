<?php
namespace app;

use app\File;

class Input
{
    public static $syllablesword;

    public function storeCustomInputIntoArray(){
       echo "Read from file? [Y/N] \n";
       $answerIfReadFromFile = trim(fgets(STDIN, 1024));
       if(strtolower($answerIfReadFromFile) == "y") {
           echo "file name: ";
           $getFileName = trim(fgets(STDIN, 1024));
           $file = new File();
           $arrayOfStrings = $file->storeValuesFromFileIntoString($getFileName);
           $arrayOfStrings = preg_split("/[\s]+/", $arrayOfStrings);
       } else {
           echo "Irasykite zodi: \n";
           $input = trim(fgets(STDIN, 1024));
           $arrayOfStrings = preg_split("/[\s]+/", $input);
           $db = new Database("test");
           foreach ($arrayOfStrings as $word){
               Input::$syllablesword = $db->checkIfInputExistInDb("cmi", $word);
               if(Input::$syllablesword != null){
               } else {
                   $db->insertWordFromCmiIntoTable($word);
               }
           }
       }
       return $arrayOfStrings;
    }
}
?>