<?php

$host="localhost";
$db_user="root";
$db_pass="chenjs916";
$db_name="zan";


//$dsn = "mysql:host=localhost;dbname=zan";

$db = new PDO("mysql:host=".$host.";dbname=".$db_name,$db_user,$db_pass);

//$db = new PDO( $dsn ,$db_user , $db_pass );

?>