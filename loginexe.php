<?php
    //SIDIRO CONNECT
    $user='it175008';
    $pass='#Mementomori199';
    $host='localhost';
    $db = 'sindopoly_db';


    $mysqli = new mysqli($host, $user, $pass, $db,null,'/home/student/it/2017/it175008/mysql/run/mysql.sock');
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }else{
        echo "Connection successful";
        $result=mysqli_query($mysqli,"SELECT DATABASE()");//print default database
        $row = mysqli_fetch_row($result);
        printf("<br>Default database is %s", $row[0]);
    }
    //END OF SIDIRO CONNECT
    /*
    //CONNECTION BLOCK--------------------------------------------------------------------------
    //mysqli_connect("127.0.0.1","it175008","PASSWORD","sindopoly",3333);//users
    $conn = new mysqli("127.0.0.1","it175008","#Mementomori199","sindopoly",3333);//users
    //$mysqli=new mysqli("127.0.0.1","it175008","PASSWORD","sindopoly",3333);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }else{
        echo "Connection successful";
        $result=mysqli_query($conn,"SELECT DATABASE()");//print default database
        $row = mysqli_fetch_row($result);
        printf("<br>Default database is %s", $row[0],"<br>");
    }
    //CONNECTION BLOCK--------------------------------------------------------------------------
    */

    $name=$_GET['name'];
    $pass=$_GET['pass'];

    //FETCH PASSWORD THAT MATCHES THE NAME INSERTED
    $sql = "SELECT pass FROM player WHERE name='$name'";
    $sqlres=mysqli_query($conn,$sql);
    $sqlarr=mysqli_fetch_array($sqlres);
    $result=$sqlarr["pass"];
    //CHECK IF FETCHED PASSWORD MATCHES THE PASSWORD INSERTED 
    if($result==$pass){
        echo "<br>Username and password are correct, welcome ".$name;
    }else{
        echo "<br>Wrong username and/or password.Try again";
    }

    
?>
