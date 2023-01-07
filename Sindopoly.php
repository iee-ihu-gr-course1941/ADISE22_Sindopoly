<?php

  //MASTER CONNECT
  $host='localhost';
  $db = 'sindopoly_db';
  $user='it175008';
  $pass='';
  if(gethostname()=='users.iee.ihu.gr') {
      $mysqli = new mysqli($host, $user, $pass, $db,null,'/home/student/it/2017/it175008/mysql/run/mysql.sock');
  } else {
      $mysqli = new mysqli($host, $user, $pass, $db);
  }
  if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }else{
      echo ("Connected to Database of Sindopoly<br>");
  }
  //MASTER CONNECT
  

  $type=$_GET['type'];
  if($type=="create"){//GET DATA FROM LOGIN SCREEN
    echo "<br>Create game<br>";
    $gamename=$_GET['gamename'];
    $createplayer1name=$_GET['createplayer1name'];
    $createplayer2name=$_GET['createplayer2name'];
  }else if($type=="join"){
    echo "<br>Join game<br>";
    $gamename=$_GET['gamename'];
    $joinname=$_GET['joinname'];
    echo "<br>".$gamename;
    echo "<br>".$joinname;
  }

  


  //Get position of players
  $sql = "SELECT p1pos FROM game WHERE gamename='$gamename'";

  $result=mysqli_query($mysqli,$sql);

  while($row = mysqli_fetch_array($result)) {
    $pos1=$row["p1pos"];
    echo $pos1;
  }
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
        <button type="button" onclick="dice()">Roll Dice</button>
        <br><div class="cell" id="11">Player name: <p id="pname1"></p></div>
        <br><div class="cell" id="12">Player name: <p id="pname2"></p></div>
      </div>


      
    </body>
</html>
