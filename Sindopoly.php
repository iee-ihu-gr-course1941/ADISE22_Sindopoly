<?php

  require_once "S_DBConnect.php";  
  $type=$_GET['type'];//CHECK IF CREATE OR JOIN GAME
  $gamename=$_GET['gamename'];
  $youare=0;//INDICATES IF CURRENT PLAYER IS 1 OR 2 
  $youname='null';//INDICATES THE PLAYERS NAME

  if($type=="create"){//IF NEW GAME------------------------------
    echo "<br>Created game<br>";
    $createplayer1name=$_GET['createplayer1name'];
    $createplayer2name=$_GET['createplayer2name'];
    require_once "S_Create.php";
  }else if($type=="join"){//IF JOIN GAME-------------------------
    echo "<br>Joined game<br>";
    $joinname=$_GET['joinname'];
    require_once "S_Join.php"; 
  }

  if($youname="null"){
    echo "<script type='text/javascript'>alert('ERROR')</script>";

  }else{
    echo "<script type='text/javascript'>alert('Welcome Player " . json_encode($youare) . " Username: " . json_encode($youname) . "')</script>";

  }
  /*
  //Get position of players
  $sql = "SELECT p1pos FROM game WHERE gamename='$gamename'";
  $result=mysqli_query($mysqli,$sql);
  while($row = mysqli_fetch_array($result)) {
    $pos1=$row["p1pos"];
    //echo $pos1;
  }
  */
?>
<html>
    <head>
        <title>Sindopoly</title>
        <link rel="stylesheet" type="text/css" href="Sindopoly.css">    
    </head>
    <body>
      <div class="board">
        <div class="cell" id="1">Go</div>
        <div class="cell" id="2">Mediterranean Avenue</div>
        <div class="cell" id="3">Community Chest</div>
        <div class="cell" id="4">Baltic Avenue</div>
        <div class="cell" id="5">Income Tax</div>
        <div class="cell" id="6">Reading Railroad</div>
        <div class="cell" id="7">Oriental Avenue</div>
        <div class="cell" id="8">Chance</div>
        <div class="cell" id="9">Vermont Avenue</div>
        <div class="cell" id="10">Connecticut Avenue</div>
        <!-- additional cells go here -->
        <button type="button" onclick="dicephp()">Roll Dice PHP</button>
        <br><div class="cell" id="11">Player name: <p id="pname1"></p></div>
        <br><div class="cell" id="12">Player name: <p id="pname2"></p></div>
      </div>
    </body>
</html>
