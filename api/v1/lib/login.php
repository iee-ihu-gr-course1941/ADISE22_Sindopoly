<?php
if(!defined('Access')) {
	   die('Direct access not permitted');
}

$gamename="metal";
$p1name="gear";
$p2name="solid"

function give(){

    echo "<br>IM FROM INSIDE THE LOGIN FUNCTION";
    global $mysqli;
    $sql = "INSERT INTO sgame(gamename,p1name,p2name) VALUES ('$gamename','$p1name','$p2name')";
    $mysqli->query($sql);
    echo "<br>DID THE QUERY";
}
function get(){
    echo "fat";
}
?>