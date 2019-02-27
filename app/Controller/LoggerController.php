<?php
namespace App\Controller;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerController
{
    private $log;

    public function __construct()
    {
        $this->log = new Logger('name');
    }

    public function infoLogger($start)
    {
        $this->log->pushHandler(new StreamHandler(PATH . '/log.txt', Logger::INFO));
        $getTime = microtime(true) - $start;
        $this->log->info('Run time', array('Run time' => $getTime));
    }
}





