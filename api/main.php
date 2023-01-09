<?php
require_once "dbconnect.php";

require_once "login.php";

require_once "game.php";


$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'),true);

$gamename="test0";
$p1name="test1";
$p2name="test2";
//$request_path = trim($_SERVER['PATH_INFO'],'/');
//$GLOBALS['input'] = json_decode(file_get_contents('php://input'), true);

/*
switch($r=array_shift($request)){
    case 'exchange':
        if($method=='GET'){
            printgame();
        }break;
}
*/

$p1name=$input['p1'];


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






/*
switch ($request[0]) {
    case 'exchange':
        printgame();

        
        if ($method == 'POST') {
            echo "POST COMPLETE";
            //givedata();
        }
        break;
}*/
?>


