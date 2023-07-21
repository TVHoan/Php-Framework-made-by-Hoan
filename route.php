<?php
function Route($route){
    // define route here
    $route->get('/', 'home/index');
    $route->get('/hoan', [ new app\main\controllers\SiteController(),'index']);

}