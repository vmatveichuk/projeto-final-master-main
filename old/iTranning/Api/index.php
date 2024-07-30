<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, if-none-match, X-Auth-Token, X-Auth-Hash, X-Auth-Timestamp");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");

require_once '../main.php';

$url = $_GET['url'];
$url = explode('/', $url);

$class = $url[0];
$method = $url[1];

require_once "./controller/{$url[0]}.php";

$inst = new $class();
$inst->$method();