<?php
require_once "dbconnect.php";

require_once "login.php";

require_once "game.php";


$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'),true);

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


if($request[0]=='show'){
    printgame();
}
if($request[0]=='showfull'){
    printgameall();
}
if($method=='POST'){
    defaultgame();
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

