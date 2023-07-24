<?php

namespace app\core;

class DbModel
{
    public array $condition;
    public function insert(){
            $db = new  Db();
            $db->table("user")->insert()->execute();
    }
    public function update(){

    }
    public function delete(){

    }
    public function select(){

    }
    public function findone($id){

    }
    public function where(){

    }
}