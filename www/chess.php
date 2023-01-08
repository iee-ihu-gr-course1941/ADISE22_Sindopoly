<?php
require_once "../lib/dbconnect.php";
require_once "../lib/board.php";
require_once "../lib/game.php";
require_once "../lib/users.php";

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$request_path = trim($_SERVER['PATH_INFO'],'/');
$input = json_decode(file_get_contents('php://input'),true);
if($input==null) {
    $input=[];
}
if(isset($_SERVER['HTTP_X_TOKEN'])) {
    $input['token']=$_SERVER['HTTP_X_TOKEN'];
} else {
    $input['token']='';
}
//
// Έχουμε αλλάξει την δομή του chess.php σε περισσότερο compact ώστε να θυμίζει καλύτερα τον σχεδιασμό του API.
// Το παλιό αρχείο είναι το chess-orig.php
//
if (preg_match('/^board$/', $request_path, $matches) ) {
    if($method=='GET') { show_board($input);}
    elseif($method=='POST') { reset_board();  show_board($input);}
    else { header('HTTP/1.1 405 Method Not Allowed');}
} else if (preg_match('/^board\/piece\/([0-9])\/([0-9])$/', $request_path, $matches )) {
    if($method=='GET') { show_piece($matches[1],$matches[2]); }
    elseif($method=='PUT') {move_piece($matches[1],$matches[2],$input['x'],$input['y'], $input['token']); }    
    else {header('HTTP/1.1 405 Method Not Allowed');}
} else if (preg_match('/^status$/', $request_path, $matches )) {
    if($method=='GET') {show_status();}
    else {header('HTTP/1.1 405 Method Not Allowed');}
} else if (preg_match('/^players\/([BW])$/', $request_path, $matches) ) {
    if($method=='GET') { show_user($matches[1]);} 
    elseif($method=='PUT') { set_user($matches[1],$input);}
    else  {header('HTTP/1.1 405 Method Not Allowed');}
} else if (preg_match('/^players\/([^BW])$/', $request_path, $matches) ) {
        header("HTTP/1.1 404 Not Found");
		print json_encode(['errormesg'=>"Player ($matches[1] not found."]);
} else {
    header("HTTP/1.1 404 Not Found");
}


?>
