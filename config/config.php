<?php
//error_reporting(E_ALL | E_DEPRECATED | E_STRICT);
error_reporting(E_ALL);
ini_set("display_errors", "0");
/*
 * set default time-zone to confirm the timezone
 * else it will show an error that system time is not reliable
 * Change it as per your timezone
 */
date_default_timezone_set('Asia/Kolkata');
/*
 * set maximum script execution time to overcome
 * timeout situations
 * I have set it for 5 minutes, i.e. 5 mins * 60 seconds,
 * But dont use unlimited or too much time as it may cause
 * too much server load and even breakdown
 */
set_time_limit(10 * 60);
//amit set config
define('CURPAGE', basename($_SERVER['PHP_SELF'])); // basename($_SERVER['PHP_SELF']); /* Returns The Current PHP File Name */ 
define('QSTRGET', urldecode($_SERVER['QUERY_STRING'])); //   echo urldecode($_SERVER['QUERY_STRING']); 
define('SESSVAR', 'Office Billing Software'); //   echo urldecode($_SERVER['QUERY_STRING']); 
define('DESCRIPTION', 'Office Billing Software');
define('AUTHOR', 'Office Billing Software');

$base = "project";
$server = "localhost";
$user = "root";
$pass = "";
global $db;
//Open a new connection to the MySQL server
$db = new mysqli($server, $user, $pass, $base);
//Output any connection error
if ($db->connect_error) {
  // die('Error : (' . $db->connect_errno . ') ' . $db->connect_error);
  header("Location: ../404.php");
}

// http://".HOST."/menu/test.php

