<?php
require_once "dbconnect.php";
require_once "game.php";
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'),true);

$iam=$input['iam'];
$gamename=$input['gamename'];

echo "DATA SENT TO SERVER: ".json_encode($input)."";//FOR DEBUG
echo "<br>OUTPUT TO FRONTEND:<br>(Note: For simplicity and ease of understanding JSON output has been replaced by simple echo text.For example of JSON output see joingame() function)<br><br>";

switch($r=array_shift($request)){
    case 'creategame' :
        if($method=='POST'){
            creategame();
        }else { header('HTTP/1.1 405 Method Not Allowed');}
    break;
    case 'joingame' :
        if($method=='POST'){
            joingame();
        }else { header('HTTP/1.1 405 Method Not Allowed');}
    break;
    case 'show' :
        if($method=='GET'){
            printboard();
        }else { header('HTTP/1.1 405 Method Not Allowed');}
    break;
    case 'rolldice' :
        if($method=='POST'){
            rolldice();
        }else { header('HTTP/1.1 405 Method Not Allowed');}
    break;
    
}

endcheck();//CHECK IF ANY PLAYER'S BALANCE IS LESS THAN 0

printboard();//SENDS ALL THE INFORMATION OF THE GAME BEING PLAYED TO THE FRONTEND


//FOR DEBUG
//echo "<br><br>Your method is : ".$method;
//echo "<br><br>Player: ".$iam." has finished his turn<br>";
//echo "<br>Player ".$turn." plays next";
?>


