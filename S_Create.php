<?php
    global $mysqli;
    global $gamename;
    global $createplayer1name;
    global $createplayer2name;
    global $youare;
    global $youname;
  
    //CHECK IF GAME WITH SAME GAMENAME ALREADY EXISTS
    $found=0;//STAYS 0 IF IDENTICAL NAME ISNT FOUND
    $sql="SELECT gamename FROM game";
    $result=mysqli_query($mysqli,$sql);
    while($row = mysqli_fetch_array($result)) {
      if($gamename==$row["gamename"]){//COMPARE ALL NAME ROWS FROM DB WITH NAME GIVEN
          $found=1; 
      }
    }

    if($found==0){//IF NOT IDENTICAL GAME WAS FOUND
        $sql="INSERT INTO game(gamename,p1name,p2name) 
        VALUES ('$gamename','$createplayer1name','$createplayer2name')";
        if ($mysqli->query($sql) === TRUE) {
            echo "<br>New game created successfully<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }else if($found==1){//IF GAME ALREADY EXISTS
        echo "Game with nickname given already exists.Go back to the previous page and join the game";
    }

    $youare=1;
    $youname=$createplayer1name;

?>
