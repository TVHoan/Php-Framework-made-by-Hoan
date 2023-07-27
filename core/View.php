<?php

namespace app\core;

class View
{
    public static function render(string $path,$params = array(),$layout = "")
    {

//        if (self::exist_view($layout)){
//            $view = self::view($path,$params);
//            $layout = self::view($layout,$params);
//            return str_replace("{{body}}",$view,$layout);
//        }
//        else{
            self::view($path,$params);
//        }

    }

    protected static function view($path,$params = array()){
        foreach ($params as $key =>$value){
            $$key = $value;
        }

        include_once __DIR__.'/../views/'.$path.".php";
    }
    protected static function exist_view($path){
       return file_exists( __DIR__.'/../views/'.$path.".php");
    }
}