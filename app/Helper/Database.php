<?php

namespace App\Helper;

use App\Config\Connection;

class Database extends Connection
{
    private function cleanTable($tableName)
    {
        $query = "DELETE FROM $tableName";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
    }

    private function insertIntoDbFromFile($fileName, $teminatedBy, $tableName, $columnName)
    {
        $query = "LOAD DATA LOCAL INFILE '$fileName' INTO TABLE $tableName LINES TERMINATED BY '$teminatedBy' ($columnName)";
        $this->connect->exec($query);
    }

    public function reuploadFileInDatabase($fileName, $teminatedBy, $tableName, $columnName)
    {
        $this->cleanTable($tableName);
        $this->insertIntoDbFromFile($fileName, $teminatedBy, $tableName, $columnName);
    }

    public function insertMatchesWithPatternsAndWord($word, $pattern)
    {
        $query = "INSERT INTO syllables (word_id, pattern_id) VALUES ((SELECT word from cmi where word='$word'), (SELECT name from patterns where name='$pattern'))";
        //$query = "INSERT INTO syllables (word_id, pattern_id) VALUES ((SELECT word from cmi where word=':word'), (SELECT name from patterns where name=':pattern'))";
        //  $stmt = $this->connect->prepare($query);
       // $stmt->execute([':word' => $this->word, ':syllables_result' => $this->syllables_result);
        $this->connect->exec($query);
    }

        public function getDataFromDb($tableName, $columnName)
    {
        $data = $this->connect->query("SELECT * FROM $tableName")->fetchAll();
        return $data;
    }

}