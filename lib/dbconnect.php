<?php

  
  $host='localhost';
  $db = 'sindopoly_db';
  $user='it175008';
  $pass='';

    //NEW MASTER CONNECT
    if(gethostname()=='users.iee.ihu.gr') {
        $mysqli = new mysqli($host, $user, $pass, $db,null,'/home/staff/asidirop/mysql/run/mysql.sock');
        } else {
            $pass=null;
            $mysqli = new mysqli($host, $user, $pass, $db);
        }
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    //NEW MASTER CONNECT
    

    /*
    //OLD MASTER CONNECT
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
  */

?>
