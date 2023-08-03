<?php

namespace app\core;

class OrmObject
{
    protected $stdclass ;
    public function __construct($datas = [])
    {
        $this->stdclass = new \stdClass();
        foreach ($datas as $key=>$value){
            $this->add($key,$value);
    }
    }
    public function add($key,$value){
        $this->stdclass->{$key} = $value;
    }
}