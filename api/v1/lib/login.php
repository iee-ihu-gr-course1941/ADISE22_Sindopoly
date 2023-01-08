<?php
if(!defined('Access')) {
	   die('Direct access not permitted');
}

function login()
{
    global $mysqli;
    $sql = "SELECT id, username, password FROM users WHERE username = ? OR email = ?";
    $st = $mysqli->prepare($sql);
    if (false === $st) {
        print json_encode(['errormesg' => "Prepare Failed"]);
        exit;
    }

    $rc = $st->bind_param("ss", $GLOBALS['input']['username'], $GLOBALS['input']['username']);
    if (false === $rc) {
        print json_encode(['errormesg' => "Bind Failed"]);
        exit;
    }




	$rc = $st->execute();
    if ( false===$rc ) {
        print json_encode(['errormesg'=>"Execute Failed"]);
        exit;
    }

    $res = $st->get_result();
    if (mysqli_num_rows($res) < 1) {
        print json_encode(['errormesg' => "Combination of username and password not found"]);
        exit;
    }
    $row = $res->fetch_assoc();

    $passwordV =  password_verify($GLOBALS['input']['pass'],$row["password"]);

    if($passwordV == false){
        print json_encode(['errormesg' => "Combination of username and password not found"]);
        exit;
    }

    $token = openssl_random_pseudo_bytes(16);
    $token = bin2hex($token);

    setcookie("tokenC", $token, time() + (86400 * 30), "/");
    $_COOKIE['tokenC'] = $token;

    $sql = "UPDATE users set token = ? WHERE username = ? OR email = ?";

    $st = $mysqli->prepare($sql);
    if (false === $st) {
        print json_encode(['errormesg' => "Prepare Failed"]);
        exit;
    }

    $rc = $st->bind_param('sss', $token, $GLOBALS['input']['username'], $GLOBALS['input']['username']);
    if (false === $rc) {
        header('Content-type: application/json');
        print json_encode(['errormesg' => "Bind Failed"]);
        exit;
    }

    $rc = $st->execute();
    if (false === $rc) {
        header('Content-type: application/json');
        print json_encode(['errormesg' => "Execute Failed2"]);
        exit;
    }
    print json_encode(['errormesg'=>"TRUE"]);
    
}

function register()
{
    global $mysqli;
    $username = $GLOBALS['input']['username'];
    $email = $GLOBALS['input']['email'];
    $password = $GLOBALS['input']['password'];
    $passwordRepeat = $GLOBALS['input']['passwordRepeat'];
    
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        print json_encode(['errormesg' => "Empty Fields" ]);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        print json_encode(['errormesg' => "Invalid Email" ]);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        print json_encode(['errormesg' => "Invalid Username" ]);
        exit();
    } else if ($password !== $passwordRepeat) {
        print json_encode(['errormesg' => "Password do not Much" ]);
        exit();
    }

    $sql_u = "SELECT username FROM users where username=?";
    $sql_e = "SELECT email FROM users where email=?";

    //u
    $st_u = $mysqli->prepare($sql_u);
    if (false === $st_u) {
        print json_encode(['errormesg' => "Prepare Failed"]);
        exit;
    }
    

    $rc_u = $st_u->bind_param("s", $GLOBALS['input']['username']);
    if (false === $rc_u) {
        print json_encode(['errormesg' => "Bind Failed"]);
        exit;
    }
    
	$rc_u = $st_u->execute();
    if ( false===$rc_u ) {
        print json_encode(['errormesg'=>"Execute Failed"]);
        exit;
    }
    $res_u = $st_u->get_result();
    //e
    $st_e = $mysqli->prepare($sql_e);
    if (false === $st_e) {
        print json_encode(['errormesg' => "Prepare Failed"]);
        exit;
    }

    $rc_e = $st_e->bind_param("s", $GLOBALS['input']['email']);
    if (false === $rc_e) {
        print json_encode(['errormesg' => "Bind Failed"]);
        exit;
    }

    $rc_e = $st_e->execute();
    if ( false===$rc_e ) {
        print json_encode(['errormesg'=>"Execute Failed"]);
        exit;
    }
    
    $res_e = $st_e->get_result();
    if (mysqli_num_rows($res_e) >= 1 and mysqli_num_rows($res_u) < 1 ) {
        print json_encode(['errormesg' => "Email already exist"]);
        exit;
    }else if(mysqli_num_rows($res_u) >= 1 and mysqli_num_rows($res_e) < 1 ){
        print json_encode(['errormesg' => "Username already exist"]);
        exit;
    }else if(mysqli_num_rows($res_e) >= 1 and mysqli_num_rows($res_u) >=1 ){
        print json_encode(['errormesg' => "Username and Email already exist"]);
        exit;
    }

    $hassedpwd = password_hash($password, PASSWORD_DEFAULT);
    echo $hassedpwd;

    global $mysqli;
    $sql = "INSERT INTO users (username,email,password) values (?, ?, ?)";

    $st = $mysqli->prepare($sql);
    if (false === $st) {
        print json_encode(['errormesg' => "Prepare Failed"]);
        exit;
    }

    $rc = $st->bind_param("sss", $GLOBALS['input']['username'], $GLOBALS['input']['email'],$hassedpwd);
    if (false === $rc) {
        print json_encode(['errormesg' => "Bind Failed"]);
        exit;
    }

	$rc = $st->execute();
    if ( false===$rc ) {
        print json_encode(['errormesg'=>"Execute Failed"]);
        exit;
    }
    print json_encode(['success'=>"TRUE"]);
}

?>