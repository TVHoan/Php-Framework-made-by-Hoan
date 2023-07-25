<?php
namespace app\main\controllers;
 use app\core\Db;

 class SiteController
{
    public function index(){
        $db = new Db();
//       return $db->table('users')->insert(["username"=>'user',"password"=>"1"])->execute();
        $datas = $db->table('users')->select()->get();
       return json_encode($datas);
    }

}