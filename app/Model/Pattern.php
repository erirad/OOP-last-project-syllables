<?php
namespace App\Model;

use App\Helper\Database;

class Pattern extends Database
{
    public function reuploadFileInDatabase($fileName, $teminatedBy, $tableName, $columnName)
    {
        parent::reuploadFileInDatabase($fileName, $teminatedBy, $tableName, $columnName);
    }

    public function getDataFromDb($tableName, $columnName)
    {
        return parent::getDataFromDb($tableName, $columnName);
    }
}