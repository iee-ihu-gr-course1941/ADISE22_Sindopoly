<?php
    echo "<b>-CONNECTION STATUS-</b><br>";
    //mysqli_connect("127.0.0.1","it175008","#Mementomori199","sindopoly",3306);//local
    //$conn = mysqli_connect("127.0.0.1","it175008","#Mementomori199","sindopoly",3306);//local

    //SIDIRO CONNECT
    $user='it175008';
    $pass='#Mementomori199';
    $host='localhost';
    $db = 'sindopoly_db';


    $mysqli = new mysqli($host, $user, $pass, $db,null,'/home/student/it/2017/it175008/mysql/run/mysql.sock');
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    } 


    /*
    //CONNECTION BLOCK--------------------------------------------------------------------------
    $conn = new mysqli("127.0.0.1","it175008","#Mementomori199","sindopoly",3333);//users
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }else{
        echo "Connection successful";
        $result=mysqli_query($conn,"SELECT DATABASE()");//print default database
        $row = mysqli_fetch_row($result);
        printf("<br>Default database is %s", $row[0]);
    }
    //CONNECTION BLOCK--------------------------------------------------------------------------
    */
    /*
    $sql = "INSERT INTO player(id,NAME) VALUES (0,'$str')";
    $sql = 'UPDATE tile SET NAME="MPD" WHERE ID=0';
    $sql = 'DELETE tile SET NAME="MPD" WHERE ID=0';
    if (mysqli_query($conn, $sql)) {
        echo "<br>New record created successfully";
    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    */
    //mysqli_close($conn);
?>