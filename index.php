<?php

/*

 __    __ _          _                              _ _ ___ 
/ / /\ \ \ |__   ___( )__    ___  _ __     ___ __ _| | / _ \
\ \/  \/ / '_ \ / _ \/ __|  / _ \| '_ \   / __/ _` | | \// /
 \  /\  /| | | | (_) \__ \ | (_) | | | | | (_| (_| | | | \/ 
  \/  \/ |_| |_|\___/|___/  \___/|_| |_|  \___\__,_|_|_| () 
                                                            
By Robert Ian Hawdon - http://robertianhawdon.me.uk


*/

$wocversion = "0.1.0";

if (isset($_COOKIE['auth']) || isset($_GET['auth'])) {
include_once "main.php";
} else {
include_once "login.php";
}

?>
