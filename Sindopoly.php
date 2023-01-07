<?php

  require_once "S_DBConnect.php";  

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

  echo rand(1,6);
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
        <script>
          function callPHPFunction() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                // The PHP function will return the result as a string, which you can use in your JavaScript code
                var result = this.responseText;
                // You can use the result in your JavaScript code here
              }
            };
            xhttp.open("POST", "<?php echo $_SERVER['PHP_SELF']; ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("function=yourFunction");
        }
</script>
    
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
