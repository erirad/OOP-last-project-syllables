<?php
namespace Api;

use App\Controller\ApiController;

require_once '/var/www/html/untitled/vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$api = new ApiController();
$api->playApi();