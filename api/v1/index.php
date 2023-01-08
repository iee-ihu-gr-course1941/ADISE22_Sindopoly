<?php
define('Access', TRUE);

require_once "lib/dbconnect.php";
require_once "lib/login.php";
require_once "lib/game.php";
require_once "lib/board.php";


$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$GLOBALS['input'] = json_decode(file_get_contents('php://input'), true);

//Print it out for example purposes.
// echo $_COOKIE['tokenC'];

echo "<br>FML<br>";
echo $request[0];
switch ($request[0]) {
    case 'login':
        if ($method == 'POST') {
            login();
            echo "did login";
        } else {
            header("HTTP/1.1 400 Bad Request");
            print json_encode(['errormesg' => "Method $method not allowed here."]);
        }
        break;

}
?>


