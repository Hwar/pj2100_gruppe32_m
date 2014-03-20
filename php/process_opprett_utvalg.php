<?php session_start();
	// Importerer nødvendige filer
	require "config.php";
	require "utvalg.php";

	
	// Nytt objekt av Utvalg classen
	$utvalg = new Utvalg($database);	
	
	if( !(empty($_POST['UtvalgNavn']) && !(empty($_POST['UtvalgInfo']) ))){
		//Opprett utvalg
		$utvalg->opprettUtvalg($_POST['UtvalgNavn'], $_POST['UtvalgInfo']);
		$_SESSION['UtvalgMeldingF'] = "Utvalg ". $_POST['UtvalgNavn'] . " lagt til.";
	}else{
		// Utvalg ble ikke oppretter
		$_SESSION['UtvalgMeldingM'] = "Utvalg ble ikke lagt til.";
	}
	
	
	// Sender bruker tilbake asap
	header("location: innlogget.php");
?>