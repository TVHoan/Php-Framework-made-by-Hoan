<?php

require_once  __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../route.php';
use app\core\Application;

    $app = new Application();

    Route($app->route);

    $app->run();
