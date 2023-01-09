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
    function joingame(){//CHECKS IF GIVEN NAME IS P1 OR P2 IN GIVEN GAME
        global $mysqli;
        global $input;
        global $iam;
        $gamename=$input['gamename'];
        $joinname=$input['joinname'];
        $iam=0;//IF NOT FOUND
        
        //CHECK FOR PLAYER 1
        $sql="SELECT p1name FROM game WHERE gamename='$gamename'";
        $result=mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);
        $namefound=$row["p1name"];
        if($namefound==$joinname){
            $iam=1;
            echo "<br> YOU ARE PLAYER 1<br>";
        }
        //CHECK FOR PLAYER 2
        $sql="SELECT p2name FROM game WHERE gamename='$gamename'";
        $result=mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);
        $namefound=$row["p2name"];
        if($namefound==$joinname){
            $iam=2;
            echo "<br> YOU ARE PLAYER 2<br>";
        }

        //SENDS TO FRONTEND IF YOU ARE P1 OR P2
        if(($iam==1)||($iam==2)){
            $sent=array("iam"=>$iam);
            header('Content-type: application/json');
            print json_encode($sent,JSON_PRETTY_PRINT);
        }else{
            $sent=array("iam"=>"notfound");
            header('Content-type: application/json');
            print json_encode($sent,JSON_PRETTY_PRINT);
        }
    }
    function rolldice(){
        global $mysqli;
        global $input;
        global $gamename;
        global $turn;
        $roll=rand(1,6);//ROLL THE DICE
        global $iam;

        //PLAYER 1-----------------------------------
        if($iam==1){
            echo "<br>STARTING ROLLDICE 1";

            $sql="SELECT pturn FROM game WHERE gamename='$gamename'";//DOWNLOAD TURN
            $result=mysqli_query($mysqli,$sql);
            $row = mysqli_fetch_array($result);
            $turn=$row["pturn"];
            echo "<br>1! PLAYER WHO PLAYS NOW IS :".$turn;
            
            if($turn==1){//IF PLAYER 1 PLAYS
                $sql="SELECT p1pos FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT POSITION
                $result=mysqli_query($mysqli,$sql);
                $row = mysqli_fetch_array($result);

                $pastpos=$row["p1pos"];
                $nextpos=$pastpos+$roll;
                if($nextpos>39){//PASSED START
                    $nextpos=$nextpos-40;
                }
                
                $sql="UPDATE game SET `p1pos`=$nextpos WHERE gamename='$gamename'";//UPLOAD NEXT POSITION
                $result=mysqli_query($mysqli,$sql);

                $turn=2;
                $sql="UPDATE game SET `pturn`=$turn WHERE gamename='$gamename'";//CHANGE TURN
                $result=mysqli_query($mysqli,$sql);
            }else{
                echo "<br>Its not you turn yet player 1.Wait for you opponent to play";
            }
        }

        //PLAYER 2-----------------------------------
        IF($iam==2){
            echo "<br>STARTING ROLLDICE 2";
            $sql="SELECT pturn FROM game WHERE gamename='$gamename'";//DOWNLOAD TURN
            $result=mysqli_query($mysqli,$sql);
            $row = mysqli_fetch_array($result);
            $turn=$row["pturn"];
            echo "<br>2! PLAYER WHO PLAYS NOW IS :".$turn;
            
            if($turn==2){//IF PLAYER 2 PLAYS
                $sql="SELECT p2pos FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT POSITION
                $result=mysqli_query($mysqli,$sql);
                $row = mysqli_fetch_array($result);

                $pastpos=$row["p2pos"];
                $nextpos=$pastpos+$roll;
                if($nextpos>39){//PASSED START
                    $nextpos=$nextpos-40;
                }
                
                $sql="UPDATE game SET `p2pos`=$nextpos WHERE gamename='$gamename'";//UPLOAD NEXT POSITION
                $result=mysqli_query($mysqli,$sql);

                $turn=1;
                $sql="UPDATE game SET `pturn`=$turn WHERE gamename='$gamename'";//CHANGE TURN
                $result=mysqli_query($mysqli,$sql);
            }else{
                echo "<br>Its not you turn yet player 2.Wait for you opponent to play";
            }
        }
    }
    function tile(){
        global $mysqli;
        global $input;
        global $gamename;
        global $iam;

        
        $sql="SELECT p1pos FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT POSITION
        $result=mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);

        $pos=$row["p1pos"];
            
        
        /*
        switch($pos){
            case 0: givemoney(200);break;
            case 1: owner();break;
            case 2: takemoney(200);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 3: owner();break;
            case 4: takemoney(100);break;//TAX
            case 5: owner();break;
            case 6: owner();break;
            case 7: takemoney(200);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 8: owner();break;
            case 9: owner();break;
            //JAIL DOESNT WORK NOW
            case 11: owner();break;
            case 12: owner();break;
            case 13: owner();break;
            case 14: owner();break;
            case 15: owner();break;
            case 16: owner();break;
            case 17: takemoney(50);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 18: owner();break;
            case 19: owner();break;
            case 20: //FREE PARKING
            case 21: owner();break;
            case 22: givemoney(200);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 23: owner();break;
            case 24: owner();break;
            case 25: owner();break;
            case 26: owner();break;
            case 27: owner();break;
            case 28: owner();break;
            case 29: owner();break;
            case 30: //JAIL DOESNT WORK NOW
            case 31: owner();break;
            case 32: owner();break;
            case 33: givemoney(200);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 34: owner();break;
            case 35: owner();break;
            case 36: givemoney(200);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 37: owner();break;
            case 38: givemoney(200);break;//TAX
            case 39: owner();break;
        }
        */
        echo "<br>FUCK".$pos;
    }
    function owner(){echo "<br>owner is";}
    function givemoney($sum){echo "<br>money given";}
    function takemoney($sum){echo "<br>money taken";}






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