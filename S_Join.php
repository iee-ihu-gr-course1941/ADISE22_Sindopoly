<?php
    global $mysqli;
    global $gamename;
    global $joinname;
  
    
    
    $sql="SELECT p2name FROM game WHERE gamename='$gamename'";
    $found=0;//STAYS ZERO IF USER NOT FOUND
    $result=mysqli_query($mysqli,$sql);
    while($row = mysqli_fetch_array($result)) {
        if($joinname==$row["p2name"]){
            $found=1; 
        }
    }
    if($found==1){
        echo "Welcome ".$joinname;
    }else{
        echo "User not found";
    }

?>
