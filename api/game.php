<?php
    function creategame(){//CREATES THE GAME WITH NAME P1NAME AND P2NAME VALUES
        global $mysqli;
        global $input;
        $gamename=$input['gamename'];
        $p1name=$input['p1name'];
        $p2name=$input['p2name'];

        $sql="INSERT INTO game(gamename,p1name,p2name) VALUES ('$gamename','$p1name','$p2name')";
        $st=$mysqli->prepare($sql);
        $st->execute();
        $sql="update game SET p1token=md5(CONCAT( p1name, NOW())) where gamename='$gamename'";
        $st=$mysqli->prepare($sql);
        $st->execute();
        $sql="update game SET p2token=md5(CONCAT( p2name, NOW())) where gamename='$gamename'";
        $st=$mysqli->prepare($sql);
        $st->execute();
    }
    function joingame(){
        global $mysqli;
        global $input;
        global $playerfound;
        $gamename=$input['gamename'];
        $pname=$input['pname'];
        
        
        $sql="SELECT p1name FROM game WHERE gamename='$gamename'";
        $st=$mysqli->prepare($sql);
        $st->execute();
        $res1 = $st->get_result();

        $sql="SELECT p2name FROM game WHERE gamename='$gamename'";
        $st=$mysqli->prepare($sql);
        $st->execute();
        $res2 = $st->get_result();

        /*
        if($res1==$pname){
            $playerfound=1;
        }else if($res2==$pname){
            $playerfound=2;
        }*/
        $playerfound=5;
        //echo "<br> 1-".$res1;
        //echo "<br> 2-".$res2;
        //echo "<br> 3-".$playerfound;
      
    }
    function change(){
        global $fml;
         $fml=2;
    }
    function printdb(){//PRINTS THE WHOLE DATABASE
        global $mysqli;//WORKS 100% !!PUT GLOBAL WHEN NEEDED
        $sql="SELECT * FROM game";
        $st=$mysqli->prepare($sql);
    
        $st->execute();
        $res = $st->get_result();
    
        header('Content-type: application/json');
        print json_encode($res->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);//WORKS 100% !!PUT GLOBAL WHEN NEEDED
    }

?>