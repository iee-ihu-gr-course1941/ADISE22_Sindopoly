<?php
session_start();
print "hello $_SESSION[username]<br>";
print "your password is $_SESSION[password]";
//print "Hello $_COOKIE[username]<br>";
//print "Your password is $_COOKIE[password]";
?>