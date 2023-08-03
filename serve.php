<?php
require_once  __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$index = __DIR__.'./public/index.php';

$host = $_ENV['HOST'];
shell_exec('php -S '.$host.'  '.$index);