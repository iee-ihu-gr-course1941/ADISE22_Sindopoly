<?php
require_once "dbconnect.php";
require_once "game.php";
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'),true);

$iam=$input['iam'];
$gamename=$input['gamename'];

echo "DATA SENT TO SERVER: ".json_encode($input)."<br><br>";//FOR DEBUG
echo "<br>OUTPUT TO FRONTEND(Note: For simplicity and ease of understanding JSON output has been replaced by simple echo text)"
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
        if($method=='POST'){
            rolldice();
            tile();
        }
    break;
}

echo "<br><br>Your method is : ".$method;
echo "<br>Player: ".$iam." has finished his turn<br>";
//echo "<br>Player ".$turn." plays next";
?>


