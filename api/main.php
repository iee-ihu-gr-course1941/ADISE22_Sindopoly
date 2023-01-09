<?php
require_once "dbconnect.php";
require_once "game.php";
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'),true);



$iam=$input['iam'];//FOR DEBUG
$gamename=$input['gamename'];

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
    case 'rolldice' :
        rolldice();
    break;

    
    
}


echo "<br>You are player: ".$iam;
echo "<br>Player ".$turn." plays next";
?>


