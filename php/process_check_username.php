<?php
	// Importerer nødvendige php filer
	require "config.php";
	require "student.php";
	
	// Lager et nytt student objekt
	$student = new Student($database);

	// henter q paramterer fra URL
	$q=$_REQUEST["q"]; 
	$respons="";

	// returnerer true/false om bruker eksisterer eller ikke
	$respons = $student->checkIfUserExist($q);
	
	
	if($respons){
		// Om sant så er brukernavn tatt
		echo "Brukernavnet er tatt i bruk";
		
	}else if(!$respons){
		// Hvis ikke er det ledig
		echo "Brukernavn er ledig";
	}else{
		echo "*";
	}

?>