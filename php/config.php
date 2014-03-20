<?php
	
 
	$db_host = "mysql.nith.no";
	$db_name = "brahan13";
	$db_user = "brahan13";
	$db_pass = "heigruppe32db"; 
	
	/*
	$db_host = "localhost";
	$db_name = "Westerdals";
	$db_user = "root";
	$db_pass = ""; */
	
	
	
	try {
		$database = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		//echo "Connected to database";		
    }
	catch(PDOException $e)
    {
		echo $e->getMessage();
    }
	
?>