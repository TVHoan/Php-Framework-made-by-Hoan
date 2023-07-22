<?php

namespace app\core;
require_once __DIR__.'/../helper/response.php';
class Response
{
    public int $statusCode;
    public function setStatusCode(int $code){
        $this->statusCode =$code;
    }
    public function SetHeader(string $header,int $code,bool $replace){
        $this->setStatusCode(404);
        addHeader($header,$replace,$this->statusCode);

    }
}