<?php
define('Access', TRUE);

require_once "lib/dbconnect.php";
require_once "lib/login.php";
require_once "lib/game.php";
require_once "lib/board.php";


$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$GLOBALS['input'] = json_decode(file_get_contents('php://input'), true);


$somedata="fuck";
//Print it out for example purposes.
// echo $_COOKIE['tokenC'];

echo "<br>FM FR";



switch ($request[0]) {
    case 'data':
        if ($method == 'POST') {
            login();
            echo "did give";
        } else if($method=="GET"){
            get();
            echo "did get"
        }
        break;
    
}




echo "<br>".$somedata;
?>


