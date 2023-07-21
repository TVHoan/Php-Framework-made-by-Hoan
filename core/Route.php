<?php
namespace app\core;
require_once __DIR__.'/../helper/httpcode.php';

class Route

{
    public Request $request;
    protected array $routes = [];

    public Response $response;

    /**
     * @param Request $request
     */
    public function __construct(Request $request,Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path ,$callback)
    {
        $this->routes['GET'][$path] =$callback;
    }
    public function post($path ,$callback)
    {
        $this->routes['POST'][$path] =$callback;
    }

    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false)
        {
//            $this->response->SetHeader("Not Found",not_found,true);
            return "Not Found";
        }
        if (is_string($callback)){
            Return $this->renderView($callback);
        }
        call_user_func($callback);
    }

    private function renderView(string $view)
    {
        include_once __DIR__.'/../views/'.$view.".php";
    }

}