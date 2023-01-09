<?php
require_once "dbconnect.php";
require_once "game.php";
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'),true);

$iam=$input['iam'];
$gamename=$input['gamename'];

echo json_encode($input);//FOR DEBUG

switch($r=array_shift($request)){
    case 'creategame' :
        creategame();
    break;
    case 'joingame' :
        joingame();
    break;
    case 'show' :
        if($method=='GET'){
            printdb();
        }
    break;
    case 'rolldice' :
        rolldice();
        tile();
    break;
}

echo "Your method is : ".$method;
echo "<br>Player: ".$iam." has finished his turn<br>";
//echo "<br>Player ".$turn." plays next";
?>


