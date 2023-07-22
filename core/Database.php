<?php

namespace app\core;
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
class Database
{
public $host ;
public $dbname;
public $username;
public $password;

}