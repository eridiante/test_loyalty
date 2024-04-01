<?php

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Database\Capsule\Manager as Capsule;
use Pecee\SimpleRouter\SimpleRouter as Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_ENV['DEV']) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('error_log', __DIR__ . '/logs/error.log');
}

$config = require_once __DIR__ . '/config/config.php';
require_once (__DIR__ . '/config/routes.php');

if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === "testing") {
    $capsule = new Capsule;
    $capsule->addConnection($config['sqlite_testing']);
} else {
    $capsule = new Capsule;
    $capsule->addConnection($config['mysql']);
}
$capsule->setAsGlobal();
$capsule->bootEloquent();

try {
    Router::start();
} catch (Throwable $e) {

}

