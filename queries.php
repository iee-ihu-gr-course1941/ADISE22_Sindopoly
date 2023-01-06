<?php
    
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
    
    $action=$_GET['action'];
    $name=$_GET['name'];
    $id=$_GET['id'];
    $pass=$_GET['pass'];
    
    echo "<br>You are doing : ".$action;
    echo "<br>With name: ".$name." and ID: ".$id."<br>";

    $stmt=$conn->prepare("INSERT INTO player(id, NAME,PASS) VALUES (?,?,?)");
    $stmt->bind_param("iss",$id,$name,$pass);
    

    if($action=='INSERT'){
        $stmt->execute();
        /*
        if (mysqli_query($conn, $sql)) {
            echo "<br>New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        */
        
    }else if($action=='SELECT'){
        $sql = "SELECT * FROM player WHERE id='$id'";
       
        $result=mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)) {
            echo "id: " . $row["id"]. " Name: " . $row["NAME"]."<br>";
        }
    } 
    

    print "<br><a href=\".\"><b>GO BACK</b></a>.";
?>