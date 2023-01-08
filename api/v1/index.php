<?php
require_once "lib/dbconnect.php";

require_once "lib/login.php";

require_once "lib/game.php";

require_once "lib/board.php";


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

//printgame();

/*
        $myqsli;//WORKS 100% !!PUT GLOBAL WHEN NEEDED
        $sql="SELECT gamename,p1name,p2name,p1money,p2money FROM game";
        $st=$mysqli->prepare($sql);
    
        $st->execute();
        $res = $st->get_result();
    
        header('Content-type: application/json');
        print json_encode($res->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);//WORKS 100% !!PUT GLOBAL WHEN NEEDED
*/

function printme(){
        global $myqsli;//WORKS 100% !!PUT GLOBAL WHEN NEEDED
        $sql="SELECT gamename,p1name,p2name,p1money,p2money FROM game";
        $st=$mysqli->prepare($sql);
    
        $st->execute();
        $res = $st->get_result();
    
        header('Content-type: application/json');
        print json_encode($res->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);//WORKS 100% !!PUT GLOBAL WHEN NEEDED
}

printme();
















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


