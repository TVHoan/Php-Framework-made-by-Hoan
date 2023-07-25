<?php
namespace app\main\controllers;
 use app\core\Db;

 class SiteController
{
    public function index(){
        $db = new Db();
//       return $db->table('users')->insert(["username"=>'user',"password"=>"1"])->execute();
        $datas = $db->table('users')->select()->get();
        debug($datas);
       return json_encode($datas);
    }
    public function create(){
     $db = new Db();

//     $datas = $db->table('users')->insert(["username"=>"admin1","password"=>"1"])->save() ;
     $datas = $db->table('users')->
         where("id",1)->
     update(["username"=>"updateadmin","password"=>"updateadmin"])->save() ;
//        $datas = $db->table('users')->where("id",1)->delete()->save() ;
     return json_encode($datas);
 }

}