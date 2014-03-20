<?php session_start();
	// Henter inn require filer
	require "config.php";
	require "student.php";		
	$student = new Student($database);

	if(!empty($_POST['GammeltPassord']) && (!empty($_POST['NyttPassord1']) && (!empty($_POST['NyttPassord2']) ))){
		
		// Sjekker at brukeren har skrevet samme passord likt 2 ganger! yey
		if($_POST['NyttPassord1'] == $_POST['NyttPassord2']){
			
			// Henter passordet til brukeren, og sjekker om bruker har skrevet riktig
			$passord = $student->getStudentPassord($_SESSION['BrukerNavn']);
			if($_POST['GammeltPassord'] == $passord){
				$student->updateStudentPass($_SESSION['BrukerNavn'], $_POST['GammeltPassord'], $_POST['NyttPassord1']);	
			}else{
				$_SESSION['byttePassord'] = "Gammelt passord er feil";
			}
			
		}else{
			$_SESSION['byttePassord'] = "De nye passordene er ikke like.";
			
		}
	}else{
		$_SESSION['byttePassord'] = "Fyll ut alle passord felt.";
	
	}
	
	header ("location: minside.php");
?>

