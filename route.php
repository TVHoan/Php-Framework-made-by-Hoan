<?php
function Route($route){
    // define route here
    $route->get('/', 'home/index');
    $route->get('/index', [ new app\main\controllers\SiteController(),'index']);
    $route->get('/create', [ new app\main\controllers\SiteController(),'create']);

}