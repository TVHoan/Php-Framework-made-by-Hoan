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
    private $layout = "layouts/layout";
    public function index(){
        $user = new Users();
        $this->view("home/index", ["users"=>$user->all()]);

    }
    public function register(){
        return $this->view("auth/register");
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
    public function view($path,$params = array()){
        View::render($path,$params,$this->layout);
    }
    public function view_with_layout($path,$params = array(),$layout=""){
        View::render($path,$params,$layout);
    }


}