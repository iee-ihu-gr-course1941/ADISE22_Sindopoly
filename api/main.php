<?php
require_once "dbconnect.php";

require_once "login.php";

require_once "game.php";


$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'),true);

$gamename=$input['gamename'];
$p1name=$input['p1name'];
$p2name=$input['p2name'];
//$request_path = trim($_SERVER['PATH_INFO'],'/');
//$GLOBALS['input'] = json_decode(file_get_contents('php://input'), true);


echo $gamename."<br>";
echo $p1name."<br>";
echo $p2name."<br>";
echo json_encode($input);


switch($r=array_shift($request)){
    case 'show' :
        printgame();
    break;
    case 'showfull' :
        printgameall();
    break;
    case 'creategame' :
        defaultgame();
    break;
}
?>


