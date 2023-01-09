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

      
        if($iam==1){
            $sql="SELECT p1pos FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT POSITION
            $result=mysqli_query($mysqli,$sql);
            $row = mysqli_fetch_array($result);
            $pos=$row["p1pos"];
            $balance="p1money";
        }else if($iam==2){
            $sql="SELECT p2pos FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT POSITION
            $result=mysqli_query($mysqli,$sql);
            $row = mysqli_fetch_array($result);
            $pos=$row["p2pos"];
            $balance="p2money";
        }
        echo "<br>YOU ARE IN ".$pos." AND YOU HAVE ".$balance;
        
        switch($pos){
            case 0: plusmoney(200,$balance);break;
            case 1: owner(1);break;
            case 2: minusmoney(50,$balance);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 3: owner(3);break;
            case 4: minusmoney(100,$balance);break;//TAX
            case 5: owner(5);break;
            case 6: owner(6);break;
            case 7: minusmoney(50,$balance);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 8: owner(8);break;
            case 9: owner(9);break;
            //JAIL DOESNT WORK NOW
            case 11: owner(11);break;
            case 12: owner(12);break;
            case 13: owner(13);break;
            case 14: owner(14);break;
            case 15: owner(15);break;
            case 16: owner(17);break;
            case 17: minusmoney(50,$balance);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 18: owner(18);break;
            case 19: owner(19);break;
            case 20: //FREE PARKING
            case 21: owner(21);break;
            case 22: plusmoney(50,$balance);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 23: owner(23);break;
            case 24: owner(24);break;
            case 25: owner(25);break;
            case 26: owner(26);break;
            case 27: owner(27);break;
            case 28: owner(28);break;
            case 29: owner(29);break;
            case 30: //JAIL DOESNT WORK NOW
            case 31: owner(31);break;
            case 32: owner(32);break;
            case 33: plusmoney(50,$balance);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 34: owner(34);break;
            case 35: owner(35);break;
            case 36: plusmoney(50,$balance);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 37: owner(37);break;
            case 38: plusmoney(200,$balance);break;//BIG TAX
            case 39: owner(39);break;
        }       
         
    }
    function owner($where,$buy,$pay){
        $sql="SELECT $bankaccount FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT TILE OWNER
        $result=mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);
        $owner=$row;

        echo "Current tile owner is".$owner;

    }
    
    function plusmoney($sum,$bankaccount){
        global $mysqli;
        global $input;
        global $gamename;
        
        $sql="SELECT $bankaccount FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT BALANCE
        $result=mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);

        $oldbalance=$row[$bankaccount];
        $newbalance=$oldbalance+$sum;

        $sql="UPDATE game SET $bankaccount=$newbalance WHERE gamename='$gamename'";//UPLOAD NEW BALANCE
        $result=mysqli_query($mysqli,$sql);
        echo "<br>Money given to ".$bankaccount." bankaccount. New balance is : ".$newbalance."<br>";
    }
    function minusmoney($sum,$bankaccount){
        global $mysqli;
        global $input;
        global $gamename;
        
        $sql="SELECT $bankaccount FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT BALANCE
        $result=mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);

        $oldbalance=$row[$bankaccount];
        $newbalance=$oldbalance-$sum;

        $sql="UPDATE game SET $bankaccount=$newbalance WHERE gamename='$gamename'";//UPLOAD NEW BALANCE
        $result=mysqli_query($mysqli,$sql);
        echo "<br>Money taken from ".$bankaccount." bankaccount. New balance is : ".$newbalance."<br>";
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