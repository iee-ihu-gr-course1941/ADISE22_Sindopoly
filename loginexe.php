<?php



    /*
    //SIDIRO 2
    $host='localhost';
    $db = 'sindopoly_db';
    require_once "db_upass.php";

    $user=$DB_USER;
    $pass=$DB_PASS;


    if(gethostname()=='users.iee.ihu.gr') {
        $mysqli = new mysqli($host, $user, $pass, $db,null,'/home/student/it/2017/it175008/mysql/run/mysql.sock');
    } else {
            $mysqli = new mysqli($host, $user, $pass, $db);
    }

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . 
        $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    //END SIDIRO 2
    */

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
