<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_practica = "127.0.0.1";
$database_practica = "practica";
$username_practica = "root";
$password_practica = "";
$practica = mysql_pconnect($hostname_practica, $username_practica, $password_practica) or trigger_error(mysql_error(),E_USER_ERROR); 
?>