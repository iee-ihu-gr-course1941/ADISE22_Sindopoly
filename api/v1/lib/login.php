<?php



echo "startlogin<br>";
function login(){

    echo "<br>INSIDE INSERT";
    global $mysqli;
    global $gamename="test";
    global $p1name;
    global $p2name;
    $sql = "INSERT INTO sgame(gamename,p1name,p2name) VALUES ('$gamename','$p1name','$p2name')";
    $mysqli->query($sql);
    echo "<br>DID THE INSERT";
}





function getdata(){
    echo "<br>DID THE SELECT";
    global $mysqli;
    $sql = "SELECT gamename FROM sgame WHERE p1name='gear'";
    $result=mysqli_query($mysqli,$sql);
    while($row = mysqli_fetch_array($result)) {
        $who=$row['gamename'];
    echo "<br>DID THE SELECT";
    }
}
echo "endlogin<br>";
?>