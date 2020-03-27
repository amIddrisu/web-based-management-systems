<?php
//MySQL server connection routines are above this point
if ($select_db) {
$time_start = microtime(true);
//query
$query = 'INSERT INTO sha1_hash (sha1_hash) VALUES ';
for ($i=1; $i<1000001; $i++) {
 $query .= "('".sha1(genRandomString(8))."'),";
    $count++;
    if ($count ==10000) {
    //result
 $result = mysql_query(rtrim($query,',')) or die ('Query error:'.mysql_error());
    if ($result) mysql_free_result($result);
    $count = 0;
    }
}

$time_end = microtime(true);
echo '<br/>'. ($time_end - $time_start);
}

//function to generate random string
function genRandomString($length)
{
$charset='abcdefghijklmnopqrstuvwxyz0123456789';
$count = strlen($charset);
 while ($length--) {
  $str .= $charset[mt_rand(0, $count-1)];
 }
return $str;
}