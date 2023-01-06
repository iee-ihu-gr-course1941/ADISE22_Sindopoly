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
    //END OF KAREZOS CONNECT


    /*
    //SIDIRO CONNECT
    $user='it175008';
    $pass='';
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
    */

    /*
    //CONNECTION BLOCK--------------------------------------------------------------------------
    //mysqli_connect("127.0.0.1","it175008","PASSWORD","sindopoly",3333);//users
    $conn = new mysqli("127.0.0.1","it175008","PASSWORD","sindopoly",3333);//users
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
    

    //FIND LAST ID
    $sql = "SELECT * FROM player ORDER BY id DESC LIMIT 1";
    $sqlres=mysqli_query($conn,$sql);
    $sqlarr=mysqli_fetch_array($sqlres);
    $result=$sqlarr["id"];
    
    $id=$result+1;
    $name=$_GET['name'];
    $pass=$_GET['pass'];
    
    //CHECK IF USERNAME ALREADY EXISTS
    $found=0;//STAYS 0 IF IDENTICAL NAME ISNT FOUND
    $sql="SELECT name FROM player";
    $result2=mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result2)) {
        if($name==$row["name"]){//COMPARE ALL NAME ROWS FROM DB WITH NAME GIVEN
            $found=1;
            //echo "<br>Comparing: ".$name." with: ".$row["name"];
        }
    }

    /*
    if($found==0){
        echo "<br>User doesnt exist";
    }else{
        echo "<br>User exists";
    }
    */
    //IF NO IDENTICAL USER FOUND THEN CREATE NEW USER
    if($found==0){
        $stmt=$conn->prepare("INSERT INTO player(id, NAME,PASS) VALUES (?,?,?)");
        $stmt->bind_param("iss",$id,$name,$pass);
        $stmt->execute();
        echo "<br>New user created";
    }elseif ($found==1){
        echo "<br>User already registered in database, no new user created";
    }
?>
