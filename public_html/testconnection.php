<?php
$server   = "localhost";
$database = "elegyadm_elegy";
$username = "elegyadmin";
$password = "FreswAZeW2";

$mysqlConnection = mysql_connect($server, $username, $password);
if (!$mysqlConnection)
{
  echo "Please try later.";
}
else
{
mysql_select_db($database, $mysqlConnection);
}
?>