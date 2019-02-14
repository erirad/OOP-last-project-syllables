<?php
require_once __DIR__ . '/vendor/autoload.php';
define('PATH', __DIR__);

use app\App;

//$delete = new \app\Connection("test");
//$delete->cleanTable("patterns");
//$delete->cleanTable("words");
//exit;

$app = new App();
$app->playApp();
