<?php

namespace app\core;

 class DbModel
{
    protected  $table = "";

    protected  $fields = [];
    protected  $condition = "1 = 1";

    protected $db ;
    /**
     * @param string $table
     */
    public function __construct()
    {
        $this->db = (new Db());
    }

    public  function create($data = []){
        $success = $this->db->table($this->table)->insert($data)->save();
        return $success;
    }
    public  function update($data){
        $success = $this->db->table($this->table)->where()->update($data)->save();
        return $success;
    }
    public  function delete($id){

        $success = $this->db->table($this->table)->where("id",$id)->delete()->save();
        return $success;
    }
    public function all($column = ["*"]){
        return $this->db->table($this->table)->where($this->condition)->select()->get();
    }
    public function findone($id){

    }
    public function where($condition = []){
            $this->condition = $condition;
            return $this;
    }
}