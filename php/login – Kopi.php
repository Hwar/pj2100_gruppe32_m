<?php session_start(); ?>
 
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/style.css">
	</head>
	<body>
 
<div id="container">
	
<div id="mainContent">
	</div>
 
<div id="footer">
<div id="footerContent">
	</div>
    </div>         
    </div>
 
<div id="headerWrap">
	<div id="headerContent">
		
	<!-- Melding som kommer når du logger ut. Skal stå på toppen av siden -->
	<?php
	if(isset($_SESSION['logout'])){
		echo $_SESSION['logout'];
		unset($_SESSION['logout']); 
		}
	?>
		
<div id="loginWrap">
<div id="login">
	
<?php	
	
	require "config.php";
	require "student.php";
	
// Setter SESSION kun viss Brukernavn er skrevet inn. Får feilmeldinge ellers	
if(isset($_POST['BrukerNavn'])){
	$_SESSION['BrukerNavn'] = $_POST['BrukerNavn'];
	}

// Sjekker om noen IKKE er innlogga. Vil da få frem innlogging og passord
if(!(isset($_SESSION['BrukerNavn'])))	{
?>



<!-- Hvor bruker skriver inn brukernavn og passord -->
<form action="login.php" method="post">
	Brukernavn: <input name="BrukerNavn" id="bruker" type="text">		
	Passord: <input name="Passord" id="pass" type="password">
	<input type="submit" value="Log in" id="submit">
</form>
					
<!-- Registreringsknapp som du bare kan se om du IKKE er innlogga -->
<a href="registrering.php">Registrering</a>



	</div>
	</div>
<div id="logo">
<img src="../bilder/westerdalslogo.png"
</div>
</div>
</div> 
</div>
</body>
</html>
 



<?php
	// Henter inn require filer
	require "config.php";
	require "student.php";		



	
// Sjekker om det står noe i feltene for brukernavn og passord
if(!empty($_POST['BrukerNavn']) && (!empty($_POST['Passord']))){
	
	// Sender det bruker skriver i feltene over til klassen student -> signIn.
	// Der vil metoden sjekke om passorder hører til brukernavnet.
	$student->signIn($_POST['BrukerNavn'], $_POST['Passord']);
	
	// Her blir det bekrefta at bruker har fått logga inn. Legger BrukerNavn inn i en SESSION, for å ta med seg videre.
	if($student->getIsSignedIn()){
		
		$_SESSION['BrukerNavn'] = $_POST['BrukerNavn'];
		
		// Sender videre til neste side
		header ("location: minSide.php");
	}
}
?>