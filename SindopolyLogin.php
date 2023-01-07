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
            </div>
            <div class="half">
                <h1>Login in existing game</h1>
            </div>
              
              
            
        </body>
</html>
