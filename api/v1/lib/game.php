<?php
    function printgame(){
        global $mysqli;
        $sql="SELECT gamename,p1name,p2name,p1money,p2money FROM game";
        $st=$mysqli->prepare($sql);
    
        $st->execute();
        $res = $st->get_result();
    
        header('Content-type: application/json');
        print json_encode($res->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);
        //DIMITRIS
        echo "YOU DID IT";
    }
?>