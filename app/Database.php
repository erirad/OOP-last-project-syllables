<?php

namespace app;

use app\Connection;

class Database extends Connection
{
    public function cleanTable($tableName)
    {
        $query = "DELETE FROM $tableName";
        $this->connect->exec($query);
    }

    public function insertIntoDbFromFile($fileName, $teminatedBy, $tableName, $columnName)
    {
        $this->cleanTable($tableName);
        $query = "LOAD DATA LOCAL INFILE '$fileName' INTO TABLE $tableName LINES TERMINATED BY '$teminatedBy' ($columnName)";

        $this->connect->exec($query);
    }

    public static function insertMatchesWithPatternsAndWord($word, $pattern)
    {
        $query = "INSERT INTO syllables (word_id, pattern_id) VALUES ((SELECT word from cmi where word='$word'), (SELECT name from patterns where name='$pattern'))";
        $this->connect->exec($query);
    }

    public function insertWordFromCmiIntoTable($word)
    {
        $query = "INSERT INTO cmi (word) VALUES ('$word')";
        $this->connect->exec($query);
    }

    public function updateCmiTableAddFinallResult($word, $result)
    {
        $query = "UPDATE cmi SET syllables_result = '$result' WHERE word = '$word'";
        $this->connect->exec($query);
    }

        public function getDataFromDb($tableName, $columnName)
    {
        $data = $this->connect->query("SELECT * FROM $tableName")->fetchAll();
        foreach ($data as $value){
            $sentenceArray[] = $value[$columnName];
        }
        return $sentenceArray;
    }

    public function checkIfInputExistInDb($tableName, $word)
    {
        $data = $this->connect->query("SELECT syllables_result FROM $tableName where word = '$word'")->fetch();
        $data = $data['syllables_result'];
        return $data;
    }

}