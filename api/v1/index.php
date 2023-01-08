<?php


require_once "lib/dbconnect.php";

require_once "lib/login.php";

require_once "lib/game.php";

require_once "lib/board.php";



$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$request_path = trim($_SERVER['PATH_INFO'],'/');
$input = json_decode(file_get_contents('php://input'),true);

//$GLOBALS['input'] = json_decode(file_get_contents('php://input'), true);

global $myqsli;
    $sql="SELECT gamename,p1name,p2name FROM sgame";
    $st=$mysqli->prepare($sql);

    $st->execute();
    $res = $st->get_result();

    header('Content-type: application/json');
    print json_encode($res->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);

switch ($request[0]) {
    case 'exchange':
        printgame();

        /*
        if ($method == 'POST') {
            echo "POST COMPLETE";
            //givedata();
        }*/
        break;
}

function printgame(){
    global $myqsli;
    $sql="SELECT gamename,p1name,p2name FROM sgame";
    $st=$mysqli->prepare($sql);

    $st->execute();
    $res = $st->get_result();

    header('Content-type: application/json');
    print json_encode($res->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);
}




?>


