<?php
require_once "dbconnect.php";

require_once "login.php";

require_once "game.php";


$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'),true);

echo json_encode($input);

$playerfound=-1;
$fml=0;
switch($r=array_shift($request)){
    case 'creategame' :
        creategame();
    break;
    case 'joingame' :
        joingame();
    break;
    case 'show' :
        printdb();
    break;
    case 'change' :
        change();
    break;
}

echo "k".$fml;
echo "h".$playerfound;
?>


