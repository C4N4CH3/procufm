<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_basedatos = "localhost";
$database_basedatos = "prueba";
$username_basedatos = "root";
$password_basedatos = "";
$basedatos = mysql_pconnect($hostname_basedatos, $username_basedatos, $password_basedatos) or trigger_error(mysql_error(),E_USER_ERROR); 
?>