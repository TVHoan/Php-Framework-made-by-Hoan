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
public string $condition = '1 = 1';
public $stmt;

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
        try {
            $this->connect = new  PDO($dns, $this->username, $this->password);
        }
        catch (\PDOException  $exception){
            exit($exception->getMessage()); ;
        }

    }
    public function table(string $table){
        $this->table = $table;
        return $this;
    }
    public function select(mixed ...$field ){
       $field_select =  count($field) >0 ? implode(",", $field) : "*";
        $this->query = "SELECT ".$field_select ." FROM ".$this->table;
        return $this;
    }
    public function insert( $data = []){
        $new_column = implode(",", array_keys($data));
        $array_columns = array_map(function ($value){
            return ":".$value;
        },array_keys($data));
        $column_template = implode(",",$array_columns);
        $this->query  = "INSERT INTO ". $this->table." (".$new_column.") VALUES (".$column_template.")";
        $this->stmt =$this->connect->prepare($this->query);
        for ($index = 0; $index<count($array_columns);$index++ ){
            $this->stmt->bindParam($array_columns[$index],array_values($data)[$index]);
        }

        return $this;
    }
    public function update( $data = [] ){
        $array_columns = array_map(function ($value){
            return $value." = :".$value;
        },array_keys($data));
        $column_template = implode(",",$array_columns);
        $this->query = "UPDATE ".$this->table." SET ".$column_template." WHERE ".$this->condition;
        $mapping_column = array_map(function ($value){
            return ":".$value;
        },array_keys($data));
        $this->stmt = $this->connect->prepare($this->query);

        for ($index = 0; $index < count($mapping_column);$index++ ){
            $this->stmt->bindParam($mapping_column[$index],array_values($data)[$index]);
        }
        return $this;
    }
    public function where(mixed ...$condition){
        if (!is_array($condition) or count($condition) == 2)
        {
            $this->condition = $condition[0]." = ".$condition[1];
            return $this;
        }
//        foreach ($condition as $value){
//            if ()
//        }
        return $this;
    }

    public function get(){

         $stmt = $this->connect->query($this->query);
         $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete()
    {
        $this->query = "DELETE FROM ".$this->table." WHERE ".$this->condition;
        $this->stmt= $this->connect->prepare($this->query);
        return $this;
    }
    public function save() : bool{
       return $this->stmt->execute();

}
}