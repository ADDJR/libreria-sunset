<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_web = "127.0.0.1";
$database_web = "web";
$username_web = "root";
$password_web = "";
$web = mysql_pconnect($hostname_web, $username_web, $password_web) or trigger_error(mysql_error(),E_USER_ERROR); 
?>