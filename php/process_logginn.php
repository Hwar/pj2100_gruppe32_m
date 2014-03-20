<?php session_start();
	// Henter inn require filer
	require "config.php";
	require "student.php";		
	$student = new Student($database);


	// For ikke å få error første gang du kjører siden
	if(!empty($_POST['BrukerNavn']) && (!empty($_POST['Passord']))){
	
	// Sender det bruker skriver i feltene over til klassen student -> signIn.
	// Der vil metoden sjekke om passorder h�rer til brukernavnet.
	$student->signIn($_POST['BrukerNavn'], $_POST['Passord']);

	// Her blir det bekrefta at bruker har f�tt logga inn. Legger BrukerNavn inn i en SESSION, for � ta med seg videre.
		if($student->getIsSignedIn()){
			$_SESSION['BrukerNavn'] = $_POST['BrukerNavn'];
			header ("location: ". $_SESSION['side']);
		}else{
			$_SESSION['feilLogin'] = "Feil brukernavn / passord.";
			header ("location: ". $_SESSION['side']);
		}	
	}else{
		$_SESSION['feilLogin'] = "Feil brukernavn / passord.";
		header ("location: ". $_SESSION['side']);
	}
?>