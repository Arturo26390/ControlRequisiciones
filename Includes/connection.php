<?php
define("DB_SERVER", "192.168.74.117");
define("DB_USER", "superuser");
define("DB_PASS", "E079D388");
define("DB_NAME", "APPS_ADMIN");

$con = mysqli_connect(DB_SERVER,DB_USER, DB_PASS) or die(mysqli_error());
mysqli_select_db($con, DB_NAME) or die("Cannot select DB");

mysqli_query($con, "SET NAMES 'utf8'");

/*define("DB_SERVER111", "192.168.74.111:33306");
define("DB_USER111", "superuser");
define("DB_PASS111", "E079D388");
define("DB_NAME111", "SIMBA");

$con_111 = mysql_connect(DB_SERVER111,DB_USER111, DB_PASS111) or die(mysql_error());
mysql_select_db(DB_NAME111) or die("Cannot select DB");*/


?>