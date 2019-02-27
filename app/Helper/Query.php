<?php

namespace App\Helper;

use App\Config\Connection;

class Query extends Connection
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Connection::conn()->getConn();
    }


    public function reuploadFileInDatabase($fileName, $teminatedBy, $tableName, $columnName)
    {
        $this->cleanTable($tableName);
        $this->insertIntoDbFromFile($fileName, $teminatedBy, $tableName, $columnName);
    }

    private function cleanTable($tableName)
    {
        $query = DB::sql()
            ->delete($tableName)
            ->get();
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
    }

    private function insertIntoDbFromFile($fileName, $teminatedBy, $tableName, $columnName)
    {
        $query = "LOAD DATA LOCAL INFILE '$fileName' INTO TABLE $tableName LINES TERMINATED BY '$teminatedBy' ($columnName)";
        $this->connect->exec($query);
    }

        public function getDataFromDb($tableName, $columnName)
    {
        $data = $this->connect->query("SELECT $columnName FROM $tableName")->fetchAll();
        return $data;
    }

}