<?php
if(!defined('Access')) {
	   die('Direct access not permitted');
}

$host='localhost';
$db = 'sindopoly_db';
$user='it175008';
$pass='';


if(gethostname()=='users.iee.ihu.gr') {
	$mysqli = new mysqli($host, $user, $pass, $db,null,'/home/student/it/2017/it75008/mysql/run/mysql.sock');
    echo "Exo syndethei sto database mia xara<br>";
} else {
        $mysqli = new mysqli($host, $user, $pass, $db);
        echo "Connected classic";
}

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . 
    $mysqli->connect_errno . ") " . $mysqli->connect_error;
}?>
