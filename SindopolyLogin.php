<html>
    <head>
        <title>Sindopoly Login</title>
        <link rel="stylesheet" type="text/css" href="SindopolyLogin.css">
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
        
        //MASTER CONNECT
        ?>
    </head>
        <body>
            <div class="mid">
                <h1>Welcome to Sindopoly</h1>
                <p>---Connection Status---</p>
                <p>
                    <?php
                        if ($mysqli->connect_errno) {
                            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                        }else{
                            echo "Connection successful";
                        }
                    ?>
                </p>
            </div>
            <div class="half">
                <h1>Create new game</h1>
                <h3>To create a new game give the game a nickname and insert the usernames of the players</h3>
                <form action="Sindopoly.php" method="GET">
                    Game's nickname: <input name="name">
                    <br>
                    Player 1 username: <input name="player1name">
                    <br>
                    Player 2 username: <input name="player2name">
                    <br>
                    <input type="submit" value="Start game!">
                </form>
            </div>
            <div class="half">
                <h1>Login in existing game</h1>
                <h3>To join a game insert the game's nickname and your username</h3>
                <form action="Sindopoly.php" method="GET">
                    Game name: <input name="name">
                    <br>
                    Username: <input name="player1name">
                    <br>
                    <input type="submit" value="Join game!">
                </form>
            </div>
              
              
            
        </body>
</html>
