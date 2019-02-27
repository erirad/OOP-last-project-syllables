<?php
require_once __DIR__ . '/vendor/autoload.php';

define('PATH', __DIR__);

use App\Controller\Navigation;

$play = new Navigation();
$play->menu();
