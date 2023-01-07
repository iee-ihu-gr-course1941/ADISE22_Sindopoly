<?php
  global $mysqli;
  global $gamename;
  global $createplayer1name;
  global $createplayer2name;

  $sql="INSERT INTO shitposts(id,name,pass) VALUES ('$gamename','$createplayer1name','$createplayer2name')";
        if ($mysqli->query($sql) === TRUE) {
        echo "<br>New record created successfully<br>";
      } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
      }
?>
