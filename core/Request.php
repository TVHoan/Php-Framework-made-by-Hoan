<?php

namespace app\core;

class Request
{
    public function path(){
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        $postion = strpos($path,'?');
        if ($postion===false){
            return $path;
        }
        return substr($path,0,$postion);
    }
    public function method(){
         return $_SERVER["REQUEST_METHOD"];
    }
    public function get(){
        return $_GET;
    }
    public function post(){
        return $_POST;
    }

}