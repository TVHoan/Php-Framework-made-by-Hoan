<?php
$index = __DIR__.'./public/index.php';

$host = "localhost:5000";

shell_exec('php -S '.$host.'  '.$index);