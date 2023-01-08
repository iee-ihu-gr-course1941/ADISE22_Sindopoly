<?php
if (!defined('Access')) {
    die('Direct access not permitted');
}

function joingame()
{

    global $mysqli;

    $sqlcheck = "Select * from players";
    $st = $mysqli->prepare($sqlcheck);
    if (false === $st) {
        print json_encode(['errormesg' => "Prepare Failed"]);
        exit;
    }

    $rc = $st->execute();
    if (false === $rc) {
        print json_encode(['errormesg' => "Execute Failed"]);
        exit;
    }
    $res2 = $st->get_result();
    if (mysqli_num_rows($res2) == 2) {
        print json_encode(['errormesg' => "Max players"]);
        exit;
    }

    $sql = "INSERT INTO players (id,username,token) SELECT id,username,token
    FROM users
    WHERE token = ?;";
    $st = $mysqli->prepare($sql);
    if (false === $st) {
        print json_encode(['errormesg' => "Prepare Failed"]);
        exit;
    }

    $rc = $st->bind_param("s", $_COOKIE['tokenC']);
    if (false === $rc) {
        print json_encode(['errormesg' => "Bind Failed"]);
        exit;
    }

    $rc = $st->execute();
    if (false === $rc) {
        print json_encode(['errormesg' => "Execute Failed"]);
        exit;
    }

    if (mysqli_num_rows($res2) == 1) {
        $sql= "INSERT INTO `game_status` (`status`) VALUES('start_game')";
        $st = $mysqli->prepare($sql);
        $st->execute();
        echo "player 2 joined";
        echo "start Game";

        exit;
    }
    $sql= "INSERT INTO `game_status` (`status`) VALUES('initalized')";
    $st = $mysqli->prepare($sql);
	$st->execute();
    echo "player 1 joined";
}

function showStatus()
{

    global $mysqli;
    // check_abort();
    $sql = "SELECT * FROM game_status";
    $st = $mysqli->prepare($sql);
    $st->execute();
    $res = $st->get_result();
    header('Content-type: application/json');
    print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

function showBoard()
{

    global $mysqli;
    // check_abort();
    $sql = "SELECT * FROM Board order by x,y";
    $st = $mysqli->prepare($sql);
    $st->execute();
    $res = $st->get_result();
    header('Content-type: application/json');
    print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

function showPieces()
{

    global $mysqli;
    // check_abort();
    $sql = "SELECT * FROM pieces where available=TRUE order by pieceID";
    $st = $mysqli->prepare($sql);
    $st->execute();
    $res = $st->get_result();
    header('Content-type: application/json');
    print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}


function read_status()
{
    global $mysqli;
    $sql = 'select * from game_status';
    $st = $mysqli->prepare($sql);
    $st->execute();
    $res = $st->get_result();
    $status = $res->fetch_assoc();
    return ($status);
}

function checkWin()
{
    global $mysqli;
    $board = array();
    
    $id = 0;
    for ($x = 0; $x <= 3; $x++) {
        $board[$x] = array();
        for ($y = 0; $y <= 3; $y++) {
            $board[$x][$y] = read_piecesBoard()[$id];
            $id++;
        }
    }
    
    for($x = 0; $x <=3; $x++){
        $wonC = 
        $board[$x][0]['piececolor'] == $board[$x][1]['piececolor'] 
        && $board[$x][0]['piececolor'] == $board[$x][2]['piececolor']
        && $board[$x][0]['piececolor'] == $board[$x][3]['piececolor']  
        && $board[$x][0]['piececolor'] != null;

        $wonSh = 
        $board[$x][0]['shape'] == $board[$x][1]['shape'] 
        && $board[$x][0]['shape'] == $board[$x][2]['shape']
        && $board[$x][0]['shape'] == $board[$x][3]['shape']  
        && $board[$x][0]['shape'] != null;

        $wonS = 
        $board[$x][0]['size'] == $board[$x][1]['size'] 
        && $board[$x][0]['size'] == $board[$x][2]['size']
        && $board[$x][0]['size'] == $board[$x][3]['size']  
        && $board[$x][0]['size'] != null;

        $wonH = 
        $board[$x][0]['hole'] == $board[$x][1]['hole'] 
        && $board[$x][0]['hole'] == $board[$x][2]['hole']
        && $board[$x][0]['hole'] == $board[$x][3]['hole']  
        && $board[$x][0]['hole'] != null;

        if($wonC || $wonSh || $wonS || $wonH){
            setwon();
            exit;
        }
    }
    for($x = 0; $x <=3; $x++){
        $wonC = 
        $board[0][$x]['piececolor'] == $board[1][$x]['piececolor'] 
        && $board[0][$x]['piececolor'] == $board[2][$x]['piececolor']
        && $board[0][$x]['piececolor'] == $board[3][$x]['piececolor']  
        && $board[0][$x]['piececolor'] != null;

        $wonSh = 
        $board[0][$x]['shape'] == $board[1][$x]['shape'] 
        && $board[0][$x]['shape'] == $board[2][$x]['shape']
        && $board[0][$x]['shape'] == $board[3][$x]['shape']  
        && $board[0][$x]['shape'] != null;

        $wonS = 
        $board[0][$x]['size'] == $board[1][$x]['size'] 
        && $board[0][$x]['size'] == $board[2][$x]['size']
        && $board[0][$x]['size'] == $board[3][$x]['size']  
        && $board[0][$x]['size'] != null;

        $wonH = 
        $board[0][$x]['hole'] == $board[1][$x]['hole'] 
        && $board[0][$x]['hole'] == $board[2][$x]['hole']
        && $board[0][$x]['hole'] == $board[3][$x]['hole']  
        && $board[0][$x]['hole'] != null;

        if($wonC || $wonSh || $wonS || $wonH){
            setwon();
            exit;
        }
    }
    $wonC = 
    $board[0][0]['piececolor'] == $board[1][1]['piececolor'] 
    && $board[0][0]['piececolor'] == $board[2][2]['piececolor']
    && $board[0][0]['piececolor'] == $board[3][3]['piececolor']  
    && $board[0][0]['piececolor'] != null;

    $wonSh = 
    $board[0][0]['shape'] == $board[1][1]['shape'] 
    && $board[0][0]['shape'] == $board[2][2]['shape']
    && $board[0][0]['shape'] == $board[3][3]['shape']  
    && $board[0][0]['shape'] != null;

    $wonS = 
    $board[0][0]['size'] == $board[1][1]['size'] 
    && $board[0][0]['size'] == $board[2][2]['size']
    && $board[0][0]['size'] == $board[3][3]['size']  
    && $board[0][0]['size'] != null;

    $wonH = 
    $board[0][0]['hole'] == $board[1][1]['hole'] 
    && $board[0][0]['hole'] == $board[2][2]['hole']
    && $board[0][0]['hole'] == $board[3][3]['hole']  
    && $board[0][0]['hole'] != null;

    if($wonC || $wonSh || $wonS || $wonH){
        setwon();
        exit;
    }

    $wonC = 
    $board[0][3]['piececolor'] == $board[1][2]['piececolor'] 
    && $board[0][3]['piececolor'] == $board[2][1]['piececolor']
    && $board[0][3]['piececolor'] == $board[3][0]['piececolor']  
    && $board[0][3]['piececolor'] != null;

    $wonSh = 
    $board[0][3]['shape'] == $board[1][2]['shape'] 
    && $board[0][3]['shape'] == $board[2][1]['shape']
    && $board[0][3]['shape'] == $board[3][0]['shape']  
    && $board[0][3]['shape'] != null;

    $wonS = 
    $board[0][3]['size'] == $board[1][2]['size'] 
    && $board[0][3]['size'] == $board[2][1]['size']
    && $board[0][3]['size'] == $board[3][0]['size']  
    && $board[0][3]['size'] != null;

    $wonH = 
    $board[0][3]['hole'] == $board[1][2]['hole'] 
    && $board[0][3]['hole'] == $board[2][1]['hole']
    && $board[0][3]['hole'] == $board[3][0]['hole']  
    && $board[0][3]['hole'] != null;
    if($wonC || $wonSh || $wonS || $wonH){
        setwon();
        exit;
    }

    $sql= "select count(*) from Board where pieceID is not null";
    $st = $mysqli->prepare($sql);
    $st->execute();
    $res = $st->get_result();
    if (mysqli_num_rows($res) == 16) {
        print json_encode(['won'=>'Draw']);
        exit;
    }


}

function setDraw(){
    global $mysqli;
    $sql= "INSERT INTO game_status (status,turn,state,won) select 'end_game',g.turn,g.state,'draw' from game_status g ORDER BY id DESC LIMIT 1";
    $st = $mysqli->prepare($sql);
    $st->execute();
}

function setwon(){
    echo "won";
    global $mysqli;
    $sql= "select turn from game_status ORDER BY id DESC LIMIT 1";
    $st = $mysqli->prepare($sql);
    $st->execute();
    $res = $st->get_result();
    $id = $res->fetch_assoc();

    $sql= "select username from players where player = ?";
    $st = $mysqli->prepare($sql);
    
    $rc = $st->bind_param("i", $id['turn']);
    $st->execute();
    $res = $st->get_result();
    $username = $res->fetch_assoc();
    print json_encode(['won'=>$username['username']]);


    $sql= "INSERT INTO game_status (status,turn,state,won) select 'end_game',g.turn,g.state,? from game_status g ORDER BY id DESC LIMIT 1";
    $st = $mysqli->prepare($sql);
    $rc = $st->bind_param("s", $username['username']);
    $st->execute();
}

function check_abort()
{
    global $mysqli;

    $sql = "update game_status set status='abord_game', 
    result=if(turn='0','1'),turn=null where turn is not null and
     change<(now()-INTERVAL 5 MINUTE) and status='start_game'";
    $st = $mysqli->prepare($sql);
    $st->execute();
}
