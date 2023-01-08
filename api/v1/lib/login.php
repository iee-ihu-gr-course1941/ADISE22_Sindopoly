<?php
if(!defined('Access')) {
	   die('Direct access not permitted');
}
echo "<br>IM OUTSIDE THE LOGIN FUNCTION";
function login(){

    echo "<br>IM FROM INSIDE THE LOGIN FUNCTION";
    global $mysqli;
    $sql = "INSERT INTO sgame(gamename,p1name,p2name) VALUES ('kostis','xontros','kolos')";
    $mysqli->query($sql);
    echo "<br>DID THE QUERY";
}
?>