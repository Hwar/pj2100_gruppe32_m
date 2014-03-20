<?php session_start(); 
	require "config.php";
	require "utvalg.php";
	
	$utvalg = new Utvalg($database);
	
	// Sjekker om btnMeldUt har blikk trykket på.
	if (array_key_exists('btnMeldUt', $_POST)) {
	 	// Henter hvilket utvalg som er markert i dropdown menyen!
		echo $_POST['utvalg'];
		
	 	// Fjerner bruker fra utvalg
		$utvalg->meldUtStudent($_SESSION['BrukerNavn'], $_POST['utvalg']); 	
	
		//  Går tilbake til "minside"
	  	header ("location: minside.php"); 
	} 
?>