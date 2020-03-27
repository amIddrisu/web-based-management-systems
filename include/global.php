<?php
session_start();
//ob_flush();
require 'util.php';

global $role_users;
global $link;
 
$host="localhost";
$dbuser='root';
$dbpassword='';
$dbdatabase='qmsdb';
$link=mysqli_connect($host,$dbuser,$dbpassword) or die("did not connect");
mysqli_select_db($link,$dbdatabase) or die("please select database");



?>
