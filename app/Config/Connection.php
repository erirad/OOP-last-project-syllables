<?php
namespace App\Config;

use PDO;

class Connection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "test";
    protected $connect;
    private static $instance = null;

    private function __construct()
    {
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

    public static function conn()
    {
        if(self::$instance == null){
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function getConn()
    {
        return $this->connect;
    }
}