<?php
namespace app;

use PDO;

class Connection
{
    protected $host = "localhost";
    protected $username = "root";
    protected $password = "root";
    protected $database;
    protected $connect;

    public function __construct($database)
    {
        $this->database = $database;
        try
        {
            $connect = new PDO("mysql:host=$this->host; dbname=$this->database", $this->username, $this->password, array(PDO::MYSQL_ATTR_LOCAL_INFILE => true,));
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connect = $connect;
        }
        catch(PDOException $error)
        {
            echo $error->getMessage();
        }
    }
}
