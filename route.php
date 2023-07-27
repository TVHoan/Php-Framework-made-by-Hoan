<?php
function Route($route){
    // define route here
//    $route->get('/', 'home/index');
    $route->get('/', [ new app\main\controllers\SiteController(),'index']);
    $route->get('/register', [ new app\main\controllers\SiteController(),'register']);
    $route->post('/register', [ new app\main\controllers\SiteController(),'create']);

}