<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "root";
    private $database;
    private $connect;

    public function __construct($database)
    {
        $this->database = $database;
        try
        {
            $connect = new PDO("mysql:host=$this->host; dbname=$this->database", $this->username, $this->password, array(PDO::MYSQL_ATTR_LOCAL_INFILE => true,));
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'database Success';
            $this->connect = $connect;
        }
        catch(PDOException $error)
        {
            echo $error->getMessage();
        }
    }

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

    public function getDataFromDb($tableName)
    {
        $data = $this->connect->query("SELECT * FROM $tableName")->fetchAll();
        foreach ($data as $value){
            $sentenceArray[] = $value['word'];
        }
        return $sentenceArray;
    }

}




$db = new Database("test");
//$db->insertIntoDbFromFile("text.txt", "\n", "patterns", "name");
//$db->insertIntoDbFromFile("inputfile.txt", " ", "words", "word");
$print = $db->getDataFromDb("words");
print_r($print);







