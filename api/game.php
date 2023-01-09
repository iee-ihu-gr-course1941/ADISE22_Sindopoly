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
            case 1: owner('pr1',50,100,$balance);break;
            case 2: minusmoney(50,$balance);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 3: owner('pr2',50,100,$balance);break;
            case 4: minusmoney(100,$balance);break;//TAX
            case 5: owner('pr5',50,100,$balance);break;
            case 6: owner('pr6',50,100,$balance);break;
            case 7: minusmoney(50,$balance);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 8: owner('pr8',50,100,$balance);break;
            case 9: owner('pr9',50,100,$balance);break;
            //JAIL DOESNT WORK NOW
            case 11: owner('pr11',50,100,$balance);break;
            case 12: owner('pr12',50,100,$balance);break;
            case 13: owner('pr13',50,100,$balance);break;
            case 14: owner('pr14',50,100,$balance);break;
            case 15: owner('pr15',50,100,$balance);break;
            case 16: owner('pr17',50,100,$balance);break;
            case 17: minusmoney(50,$balance);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 18: owner('pr18',50,100,$balance);break;
            case 19: owner('pr19',50,100,$balance);break;
            case 20: //FREE PARKING
            case 21: owner('pr21',50,100,$balance);break;
            case 22: plusmoney(50,$balance);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 23: owner('pr23',50,100,$balance);break;
            case 24: owner('pr24',50,100,$balance);break;
            case 25: owner('pr25',50,100,$balance);break;
            case 26: owner('pr26',50,100,$balance);break;
            case 27: owner('pr27',50,100,$balance);break;
            case 28: owner('pr28',50,100,$balance);break;
            case 29: owner('pr29',50,100,$balance);break;
            case 30: //JAIL DOESNT WORK NOW
            case 31: owner('pr31',50,100,$balance);break;
            case 32: owner('pr32',50,100,$balance);break;
            case 33: plusmoney(50,$balance);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 34: owner('pr34',50,100,$balance);break;
            case 35: owner('pr35',50,100,$balance);break;
            case 36: plusmoney(50,$balance);break;//COMMUNITY CHEST AND CHANCE DONT WORK -50
            case 37: owner('pr37',50,100,$balance);break;
            case 38: plusmoney(200,$balance);break;//BIG TAX
            case 39: owner('pr39',50,100,$balance);break;
        }       
         
    }
    function owner($where,$buy,$pay,$bank){
        global $mysqli;
        global $input;
        global $gamename;
        global $iam;

        $sql="SELECT $where FROM game WHERE gamename='$gamename'";//DOWNLOAD CURRENT TILE OWNER
        $result=mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);
        $owner=$row[$where];

        echo "<br>Owner: ".$owner;

        if($owner==0){//IF NO OWNER
            $choice=$input['choice'];//PLAYERS CHOICE SENT THROUGH JSON
            if($choice=='y'){
                minusmoney($buy,$bank);
                $sql="UPDATE game SET `$where`=$iam WHERE gamename='$gamename'";//UPLOAD NEW OWNER
                $result=mysqli_query($mysqli,$sql);
                echo "<br> New owner set player ".$iam;
            }else if($choice=='n'){
                echo "<br> You didn't buy the property";
            }
        }else if($owner==$iam){//PLAYER ALREADY HAS THIS PROPERTY
            echo "<br> You already own this property<br>";
        }/*else{//PROPERTY BELONGS TO OPPONENT
            if($bank=="p1money"){$enemybank="p2money";}
            if($bank=="p2money"){$enemybank="p1money";}
            minusmoney($pay,$bank);
            plusmoney($pay,$enemybank);
            echo "You gave your opponent ".$pay." dollars";
        }*/


        //echo "My choice is ".$choice;
        //echo "<br>You are in tile ".$where;
        //echo "<br>Current tile owner is ".$owner;
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
        echo "<br>Money taken from ".$bankaccount." bank account. New balance is : ".$newbalance."<br>";
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