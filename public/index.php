<?php

require_once  __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../route.php';
require_once __DIR__.'/../helper/debug.php';
use app\core\Application;

    $app = new Application();

    Route($app->route);

    $app->run();
