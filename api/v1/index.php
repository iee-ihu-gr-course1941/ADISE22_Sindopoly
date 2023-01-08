<?php


require_once "lib/dbconnect.php";

require_once "lib/login.php";

require_once "lib/game.php";

require_once "lib/board.php";



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

/*
$message="The game is ".$gamename;
$response=array();
$response["success"]=true;
$response["message"]=$message;

echo json_encode($response);


function senddata(){
    header('Content-type: application/json');
    echo  json_encode($gamename);
}
*/

echo json_encode($gamename);

?>


