<?php

//echo "1<br>";
require_once "lib/dbconnect.php";
//echo "2<br>";
require_once "lib/login.php";
//echo "3<br>";
require_once "lib/game.php";
//echo "4<br>";
require_once "lib/board.php";
//echo "1<br>";


$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$GLOBALS['input'] = json_decode(file_get_contents('php://input'), true);

//Print it out for example purposes.
// echo $_COOKIE['tokenC'];



$gamename="metal gear";
$p1name=$_POST['p1name'];
$p2name=$_POST['p2name'];

switch ($request[0]) {
    case 'exchange':
        if ($method == 'POST') {
            echo "POST COMPLETE";
            givedata();
            
        } else if($method == 'GET'){
            echo "GET COMPLETE";
            senddata();
            
        }
        break;

}


function senddata(){
    header('Content-type: application/json');
    echo  json_encode($gamename);
}



?>


