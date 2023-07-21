<?php

require_once  __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../route.php';
use app\core\Application;

function run()
{
    ob_start();

    $app = new Application();

    Route($app->route);

    $app->run();

    return ob_get_clean();
}
