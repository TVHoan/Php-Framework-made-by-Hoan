<?php

namespace app\core;

class Application
{
    public  Route $route;
    public Request $request;
    public Response $response;
    public static Application $app;
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route( $this->request,$this->response);
        self::$app = $this;
    }

    public function run(){
        $this->route->resolve();
    }

}