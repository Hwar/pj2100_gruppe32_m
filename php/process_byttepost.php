<?php session_start();
	// Henter inn require filer
	require "config.php";
	require "student.php";		
	$student = new Student($database);

	if(!empty($_POST['passord']) && (!empty($_POST['NyEpost1']) && (!empty($_POST['NyEpost2']) ))){
		
		// Sjekker at brukeren har skrevet samme passord likt 2 ganger! yey
		if( ($_POST['NyEpost1'] == $_POST['NyEpost2'])){
			// Henter passordet til brukeren, og sjekker om bruker har skrevet riktig
			$passord = $student->getStudentPassord($_SESSION['BrukerNavn']);
			
				// Sjekker om passorder er riktig
				if($passord == $_POST['passord']){
					// Bytter eposten med det bruker har skrevet
					$student->updateStudentEpost($_SESSION['BrukerNavn'], $_POST['NyEpost2']);
				}else{
					$_SESSION['bytteEpost'] = "Passordet er feil";
				}
		}else{
			// Her kommer man om de 2 passordene man skriver ikke er rett
			$_SESSION['bytteEpost'] = "Epostene stemmer ikke eller eposten er feil";
		}
	}else{
		// hit kommer man om man ikke har fyllt ut alle feltene
		$_SESSION['bytteEpost'] = "Har du husket alle feltene??";
	}
	
	header ("location: minside.php");

?>
