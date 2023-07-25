<?php

namespace app\core;
use Dotenv\Dotenv;
use PDO;

$dotenv = Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();
class Db
{
public $host ;
public $port ;
public $sql;
public $dbname;
public $username;
public $password;

public PDO $connect;

public string $table;
public string $query;
public string $condition;

    /**
     * @param $host
     * @param $dbname
     * @param $username
     * @param $password
     */
    public function __construct()
    {
        $this->sql = $_ENV['SQL'] ?? 'mysql';
        $this->host = $_ENV['DBHOST'] ?? 'localhost';
        $this->port = $_ENV['PORT'] ?? '3306';
        $this->dbname = $_ENV['DBNAME'] ?? '';
        $this->username = $_ENV['DBUSERNAME'] ?? 'root';
        $this->password = $_ENV['DBPASSWORD'] ?? '';

        $dns = $this->sql.":host=$this->host;dbname=$this->dbname;port=".$this->port.";charset=utf8";
        $this->connect = new  PDO($dns, $this->username, $this->password);

    }
    public function table(string $table){
        $this->table = $table;
        return $this;
    }
    public function select($field = []){
       $field_select =  count($field) >0 ? implode(",", $field) : "*";
        $this->query = "SELECT ".$field_select ." FROM ".$this->table;
        return $this;
    }
    public function insert( $data = []){
        $new_column = implode(",", array_keys($data));
        $new_data = implode(",", array_values($data));
        $this->query  = "INSERT INTO ". $this->table." (".$new_column.") VALUES (".$new_data.")";
        return $this;
    }
    public function update( $column_data = ["username"=>"admin"] ){
        $new_column_data = '';
        $index = 1;
        foreach ($column_data as $key =>$value ){
            $space = "";
            if($index > 1 and $index < count($column_data))
            {
                $space = ",";
            }
            $new_column_data += $key." = ".$value.$space;
            $index++;
        }


        $this->query = "UPDATE ".$this->table."SET ".$new_column_data." WHERE ".$this->condition;
        return $this;
    }
//    public function where(mixed ...$condition){
//        $new_condition ='';
//        if (!is_array($condition) or count($condition) == 2)
//        {
//            $this->condition = $condition[0]." = ".$condition[1];
//            return $this;
//        }
//        foreach ($condition as $value){
//            if ()
//        }
//        return $this;
//    }
    public function orwhere($condtion){

    }
    public function andwhere($condtion){

    }

    public function get(){
        echo "<pre>", var_dump($this->query), "</pre>";

         $stmt = $this->connect->query($this->query);
         $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}