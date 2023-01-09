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
    function joingame(){//CHECKS IF THERE ARE THE NAMES OF THE PLAYERS PROVIDED IN PROVIDED GAME AND RETURNS THE NUMBER OF THE PLAYER THE NAME BELONGS TO
        global $mysqli;
        global $input;
        global $playerfound;
        $gamename=$input['gamename'];
        $pname=$input['pname'];
        
        //CHECK FOR PLAYER 1
        $sql="SELECT p1name FROM game WHERE gamename='$gamename'";
        $result=mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);
        $namefound=$row["p1name"];
        if($namefound==$pname){
            $playerfound=1;
        }
        //CHECK FOR PLAYER 2
        $sql="SELECT p2name FROM game WHERE gamename='$gamename'";
        $result=mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);
        $namefound=$row["p2name"];
        if($namefound==$pname){
            $playerfound=2;
        }
    }
    function rolldice(){
        global $mysqli;
        global $input;
        global $playerfound;
        global $gamename;

        $roll=rand(1,6);//ROLL THE DICE
        //if($playerfound==1){//IF CURRENT PLAYER IS PLAYER 1
            $sql="SELECT p1pos WHERE gamename='$gamename'";//DOWNLOAD CURRENT POSITION
            $result=mysqli_query($mysqli,$sql);
            $row = mysqli_fetch_array($result);
            $currentpos=$row["p1pos"];
            $nextpos=$currentpos+$roll;

            $sql="UPDATE game SET `p1pos`=$nextpos WHERE gamename='$gamename'";//UPLOAD NEXT POSITION
            $result=mysqli_query($mysqli,$sql);
        //}



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