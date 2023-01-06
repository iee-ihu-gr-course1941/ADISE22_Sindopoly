<?php

    //KAREZOS CONNECT
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
        echo "Failed to connect to MySQL: (" . 
        $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {
        echo ("connected");
    }

    
    
    //$name=$_GET['name'];
    //$pass=$_GET['pass'];

    $sql="INSERT INTO player(id,name,pass) VALUES (66,'pc','love')";
    
    

    $sql="SELECT * from player";
    $result=mysqli_query($mysqli,$sql);
    while($row = mysqli_fetch_array($result)) {
        echo "<br>id: " . $row["id"]. " Name: " . $row["NAME"];
    }
?>