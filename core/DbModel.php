<?php

namespace app\core;

class DbModel
{
    public array $condition;
    public static function connect()
    {
        return (new Db())->connect();
    }
    public static function insert(){
            $db = new  Db();
            $db->table("user")->insert()->execute();
    }
    public static function update(){

    }
    public static function delete(){

    }
    public static function all(){

    }
    public static function findone($id){

    }
    public static function where(){

    }
}