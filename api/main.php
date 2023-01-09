<?php
require_once "dbconnect.php";

require_once "login.php";

require_once "game.php";


$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'),true);

$playerfound=1;//SET BACK TO 0
$gamename=$input['gamename'];
//FOR DEBUG
echo json_encode($input);

//FOR DEBUG

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
    case 'rolldice/1' :
        rolldice1();
    break;
    case 'rolldice/2' :
        rolldice2();
    break;
}


echo "<br>You are player: ".$playerfound;
echo "<br>Player ".$turn." finished his turn";
?>


