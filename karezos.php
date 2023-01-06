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
        echo "Failed to connect to MySQL: (" . 
        $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }else{
        echo ("Connected to Database<br>");
    }
    //MASTER CONNECT
    
    
    $name=$_GET['name'];
    $pass=$_GET['pass'];

    $sql = "SELECT * FROM player ORDER BY id DESC LIMIT 1";
    $sqlres=mysqli_query($conn,$sql);
    $sqlarr=mysqli_fetch_array($sqlres);
    $result=$sqlarr["id"];
    
    $id=$result+1;

    $sql="INSERT INTO player(id,name,pass) VALUES ('$id','$name','$pass')";
        if ($mysqli->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
      }
    
    
    /*
    $sql="SELECT * from player";
    $result=mysqli_query($mysqli,$sql);
    while($row = mysqli_fetch_array($result)) {
        echo "<br>id: " . $row["id"]. " Name: " . $row["NAME"];
    }
    */
?>