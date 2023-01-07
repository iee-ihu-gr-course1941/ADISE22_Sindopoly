<?php
    global $mysqli;
    global $gamename;
    global $joinname;
    $found=0;//STAYS ZERO IF USER NOT FOUND
    global $youare;
    
    //CHECK IF JOINED PLAYER IS PLAYER 1
    $sql="SELECT p1name FROM game WHERE gamename='$gamename'";
    $result=mysqli_query($mysqli,$sql);
    while($row = mysqli_fetch_array($result)) {
        if($joinname==$row["p1name"]){
            $found=1; 
        }
    }

    //CHECK IF JOINED PLAYER IS PLAYER 2
    $sql="SELECT p2name FROM game WHERE gamename='$gamename'";
    $result=mysqli_query($mysqli,$sql);
    while($row = mysqli_fetch_array($result)) {
        if($joinname==$row["p2name"]){
            $found=2; 
        }
    }

    if($found==1){
        echo "<br>Welcome Player 1 ".$joinname."<br>";
        $youare=1;
    }else if($found==2){
        echo "<br>Welcome Player 2 ".$joinname."<br>";
        $youare=2;
    }else{
        echo "User not found in game nickname given.Try again";
    }

?>
