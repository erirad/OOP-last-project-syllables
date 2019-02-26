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

        public function getDataFromDb($tableName, $columnName)
    {
        $data = $this->connect->query("SELECT $columnName FROM $tableName")->fetchAll();
        return $data;



    }

}