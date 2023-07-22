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
        $assets = $this->isAssets($path);
        if($assets!='')
        {

           return $this->renderFile($assets);
        }
        if ($callback === false)
        {
            $this->response->SetHeader("Not Found",not_found,true);
           \header("Not Found",404,true);
            return "Not Found";
        }
        if (is_string($callback)){
            Return $this->renderView($callback);
        }
       return call_user_func($callback);
    }

    private function renderView(string $view)
    {
        include_once __DIR__.'/../views/'.$view.".php";
    }
    private function renderFile($path){
        switch (pathinfo($path, PATHINFO_EXTENSION)) {
            case 'css':
                $mimeType = 'text/css';
                break;

            case 'js':
                $mimeType = 'application/javascript';
                break;

            // Add more supported mime types per file extension as you need here

            default:
                $mimeType = 'text/html';
        }
        if(function_exists('header')){
            \header("Content-type: ".$mimeType.'; charset=utf-8');
        }
        else{
            require_once __DIR__.'/../vendor/joanhey/adapterman/src/AdapterFunctions.php';
            \header("Content-type: ".$mimeType.'; charset=utf-8');
        }
        return file_get_contents($path);
    }

    private static function isAssets($path)
    {
        $pathFile = __DIR__.'/../public'.$path;
        if(is_file($pathFile))
        {
            return $pathFile;
        }
        return '';
    }

}