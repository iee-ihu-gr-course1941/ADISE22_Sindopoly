<?php
  //KAREZOS
  $method = $_SERVER['REQUEST_METHOD'];
  $request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
  $GLOBALS['input'] = json_decode(file_get_contents('php://input'), true);
  //KAREZOS

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>;

  require_once "S_DBConnect.php";  
  require_once "S_Join.php";  

  const username="karezos";
  const pass="pass";
  echo "<br>1";
  /*
  $.ajax({
    type: 'POST',
    url: 'S_Join',
    data: {
      username: username,
      pass: pass
    },
    loginf: function (data){
      console.log(data);
    }
  });
  */
  echo "<br>2";
  /*
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

  if($youname=="null"){//GREET THE PLAYER
    echo "<script type='text/javascript'>alert('ERROR')</script>";
  }else{
    echo "<script type='text/javascript'>alert('Welcome Player " . json_encode($youare) . " Username: " . json_encode($youname) . "')</script>";
  }

  echo "<script type='text/javascript'>";
  echo "function changeText() {";
  echo "  var p1 = document.getElementById('p1name');";
  echo "  var message = " . json_encode($youname) . ";";
  echo "  p1.innerHTML = message;";
  echo "}";
  echo "</script>";
  */
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
<!--
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
        
        <button type="button" onclick="changeText()">Roll Dice PHP</button>
        <br><div class="cell" id="11"></div>
        <br><div class="cell" id="12">Player name: <p id="p2name"></p></div>
      </div>
      <p id="p1name" style="text:red;">Original</p>
    </body>
</html>
-->