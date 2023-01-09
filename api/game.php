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
    /*
    function getturn(){//CHECKS WHOSE TURN IT IS
        global $mysqli;
        global $input;
        global $playerfound;
        global $gamename;
        global $whoseturn;

        $sql="SELECT pturn FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT TURN INT
        $result=mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);
        $playerwhocanplay=$row["pturn"];

        $whoseturn=$playerwhocanplay;
        echo "<br>On start of turn he plays: ".$whoseturn;
    }
    function endturn(){//CHANGES PLAYER TURN IN DB FROM 1 TO 2 vice versa...
        global $mysqli;
        global $input;
        global $playerfound;
        global $gamename;
        global $whoseturn;

        $sql="SELECT pturn FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT TURN INT
        $result=mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);
        $playerwhocanplay=$row["pturn"];
        $whoseturn=$playerwhocanplay;

        if($whoseturn==1){
            $whoseturn=2;
            echo "<br>I AM: ".$whoseturn;
        }else if($whoseturn==2){
            $whoseturn==1;
            echo "<br>I NEED TO BECOME: ".$whoseturn;
        }

        $sql="UPDATE game SET `pturn`=$whoseturn WHERE gamename='$gamename'";//UPLOAD NEW TURN INT
        $result=mysqli_query($mysqli,$sql);

        echo "<br>On end of turn he plays: ".$whoseturn;
    }
    */
    function rolldice(){
        global $mysqli;
        global $input;
        global $playerfound;
        global $gamename;
        global $whoseturn;

        $sql="UPDATE game SET `pturn`=$whoseturn WHERE gamename='$gamename'";//UPLOAD NEW TURN INT
        $result=mysqli_query($mysqli,$sql);
        $sql="SELECT pturn FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT TURN INT
        $result=mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);
        $playerwhocanplay=$row["pturn"];
        
        $roll=rand(1,6);//ROLL THE DICE
        if($playerfound==1&&$whoseturn==1){//IF CURRENT PLAYER IS PLAYER 1
            $sql="SELECT p1pos FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT POSITION
            $result=mysqli_query($mysqli,$sql);
            $row = mysqli_fetch_array($result);

            $currentpos=$row["p1pos"];
            $nextpos=$currentpos+$roll;
            if($nextpos>39){//IF PLAYER PASSED START SUBSTRACT THE SUM OF TILES FROM HIS POSITION
                $nextpos=$nextpos-40;
            }
             
            echo "<brFOR P1->>Current:".$currentpos." -Next:".$nextpos." -Diceroll was:".$roll;
            $sql="UPDATE game SET `p1pos`=$nextpos WHERE gamename='$gamename'";//UPLOAD NEXT POSITION
            $result=mysqli_query($mysqli,$sql);
        }
        if($playerfound==2&&$whoseturn==2){//IF CURRENT PLAYER IS PLAYER 2
            $sql="SELECT p2pos FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT POSITION
            $result=mysqli_query($mysqli,$sql);
            $row = mysqli_fetch_array($result);

            $currentpos=$row["p2pos"];
            $nextpos=$currentpos+$roll;
            if($nextpos>39){//IF PLAYER PASSED START SUBSTRACT THE SUM OF TILES FROM HIS POSITION
                $nextpos=$nextpos-40;
            }
             
            echo "<br>FOR P2->Current:".$currentpos." -Next:".$nextpos." -Diceroll was:".$roll;
            $sql="UPDATE game SET `p2pos`=$nextpos WHERE gamename='$gamename'";//UPLOAD NEXT POSITION
            $result=mysqli_query($mysqli,$sql);
        }
        
        if(($playerfound==1&&$whoseturn==2)||($playerfound==2&&$whoseturn==1)){//IF ITS NOT THE CORRECT PLAYERS TURN
            echo "<br>It is not your turn yet player ".$whoseturn.".You need to wait for you opponent to play";
        }
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