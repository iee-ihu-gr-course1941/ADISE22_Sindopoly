<?php
if(!defined('Access')) {
	   die('Direct access not permitted');
}
echo "<br>IM OUTSIDE THE LOGIN FUNCTION";
function login(){

    echo "<br>IM FROM INSIDE THE LOGIN FUNCTION";
    global $mysqli;
    $sql = "INSERT INTO sgame(gamename,p1name,p2name) VALUES (?,?,?)";

    $st = $mysqli->prepare($sql);

    $rc = $st->bind_param("sss", "help", "karezos","kopsidas");

	$rc = $st->execute();
 
    print json_encode(['success'=>"TRUE"]);
}
?>