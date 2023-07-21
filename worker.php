<?php

require_once __DIR__ . '/vendor/autoload.php';

use Adapterman\Adapterman;
use Workerman\Worker;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
Adapterman::init();
$host = $_ENV['HOST'].':'. $_ENV['PORT'];
$http_worker                = new Worker('http://'.$host);
$http_worker->count         = 8;
$http_worker->name          = 'AdapterMan';

$http_worker->onWorkerStart = static function () {
    //init();
    require __DIR__.'/public/start.php';
};

$http_worker->onMessage = static function ($connection, $request) {

    $connection->send(run());
};

Worker::runAll();