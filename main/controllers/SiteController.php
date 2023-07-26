<?php
namespace app\main\controllers;
 use app\core\Db;
 use app\core\DbModel;
 use app\core\Request;
 use app\core\Route;
 use app\core\View;
 use app\main\models\Users;

 class SiteController
{
    public function index(){
        $user = new Users();
        self::view("home/index", ["users"=>$user->all()]);

    }
    public function create(Request $request){
     $user = new Users();
      $success = $user->create($request->post());
      if ($success)
      {
          Route::redirect("/");
      }
//     $datas = $db->table('users')->insert(["username"=>"admin1","password"=>"1"])->save() ;
//     $datas = $db->table('users')->
//         where("id",1)->
//     update(["username"=>"updateadmin","password"=>"updateadmin"])->save() ;
//     return json_encode($user->create(["username"=>"admin1","password"=>"1"]));
        json_encode($request->post());
 }
 public static function view($path,$params = array()){
        ${array_keys($params)[0]} = array_values($params)[0];
         include_once __DIR__.'/../../views/'.$path.".php";
 }


}