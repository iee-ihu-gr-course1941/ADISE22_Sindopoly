<?php

echo "1<br>";
require_once "lib/dbconnect.php";
echo "2<br>";
require_once "lib/login.php";
echo "3<br>";
require_once "lib/game.php";
echo "4<br>";
require_once "lib/board.php";
echo "1<br>";


$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$GLOBALS['input'] = json_decode(file_get_contents('php://input'), true);

//Print it out for example purposes.
// echo $_COOKIE['tokenC'];

echo "<br>FM FR";



switch ($request[0]) {
    case 'login':
        if ($method == 'POST') {
            login();
        } else {
            header("HTTP/1.1 400 Bad Request");
            print json_encode(['errormesg' => "Method $method not allowed here."]);
        }
        break;

}




?>


