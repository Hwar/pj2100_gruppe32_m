<?php session_start(); 
	require "config.php";
	require "student.php";
	unset($_SESSION['side']);

?>
 
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
				<div id="footerText1">
					Nordic Institute of Stage and Studio
				</div>
				<div id="footerText2">
					Westerdals School of Communication
				</div>
				<div id="footerText3">
					The Norwegian School of IT
				</div>
				<a href="http://www.niss.no"> <img src="../bilder/niss.png" class="logoer1"> </a>
				<a href="http://www.nith.no"> <img src="../bilder/nith.png" class="logoer2"> </a>
				<a href="http://www.westerdals.no"> <img src="../bilder/westerdals.png" class="logoer3"> </a>

		<!--	<div id="footerText">Westerdals School of Communication</div> -->

			</div>
    	</div>
    </div>
 
	<div id="headerWrap">
		<div id="kimWrap">
		</div>
		<div id="headerContent">
	
		<!-- Melding som kommer når du skriver feil innlogging. Skal stå på toppen av siden og med rød tekst -->		
			<div id="wrapKim">
				<div id="warning">
					<?php	
						if(isset($_SESSION['feilLogin'])){
						echo $_SESSION['feilLogin'];
						unset($_SESSION['feilLogin']);
						}
					?>
					
			</div>
			
		<!-- Melding som kommer når du logger ut. Skal stå på toppen av siden og med svart tekst-->
					<?php
						if(isset($_SESSION['logout'])){
						echo $_SESSION['logout'];
						unset($_SESSION['logout']); 
						}
					?>
					
				<div id="confirm">
					<?php
		// Melding som kommer når du registrerer en ny bruker på toppen av siden.
						if(isset($_SESSION['nyBruker'])){
						echo $_SESSION['nyBruker'];
						unset($_SESSION['nyBruker']); 
						}
					?>
				</div></div>


			<div id="logo">
			<a href="../php/login.php" ><img src="../bilder/westerdalslogo.png">

			<div id="headerMenu">
				<div id="img1">
					
<!-- 	Sjekker om du er innlogga. Er du det, så går MinSide knappen til Min Side. 
		Er du IKKE innlogga, så går knappen til Registreringssiden. -->
						
			<?php
			if(isset($_SESSION['BrukerNavn'])){
				?> 
					<a href="../php/minside.php" >
			<?php
			}else{
				?>
					<a href="../php/registrering.php" >
				<?php
			}
			?>
					
					<img src="../bilder/minside.png" 
					onmouseover="this.src='../bilder/minside-rollover.png '" 
					onmouseout="this.src='../bilder/minside.png'"/>
				</div>	
<!-- Min Side knappen ferdig -->
				
				
				
				<div id="img2">
					<a href="../php/innlogget.php" ><img src="../bilder/utvalg.png" 
					onmouseover="this.src='../bilder/utvalg-rollover2.png '" 
					onmouseout="this.src='../bilder/utvalg.png'"/></a>
				</div>
				<div id="img3">
					<a href="../php/kontaktside.php" ><img src="../bilder/kontakt.png" 
					onmouseover="this.src='../bilder/kontakt-rollover.png '" 
					onmouseout="this.src='../bilder/kontakt.png'"/></a>
				</div>
			</div>

		
<div id="loginWrap">
<div id="login">
	
<?php	
	

	

// Sjekker om noen IKKE er innlogga. Vil da få frem innlogging og passord
if(!(isset($_SESSION['BrukerNavn'])))	{
$_SESSION['side'] = "login.php";
?>



<!-- Hvor bruker skriver inn brukernavn og passord -->

<form action="process_logginn.php" method="post">
	<input pattern=".{3,}" required title="3 characters minimum" name="BrukerNavn" id="bruker" type="text" placeholder="Brukernavn"> <br>		
	<input name="Passord" id="pass" type="password" placeholder="Passord">

	<input type="submit" value="Log in" id="submit">
</form>
					
<!-- Registreringsknapp som du bare kan se om du IKKE er innlogga -->

<form action="registrering.php" method="post">
<input type="submit" value="registrer" id="registrering">
</form>


<a href="registrering.php">
	<a href="Innlogget.php">

<?php	
				
// Sjekker om noen er innlogga. Om du er innlogga, så får du fram MinSide, Logg ut knapp, og Registreringsknappen forsvinner.
}else{
	// Dev only. Sjekker hvem som er inne.
echo "Innlogga som: ". $_SESSION['BrukerNavn']. '<br>';
?>
							
<!-- Logg ut knapp -->
<form method="post" action="">
	<p><button type="submit" name="logout">Logout</button></p> 
	</form> 


<?php
	if(isset($_POST['logout'])) {  
	unset($_SESSION['BrukerNavn']); 
	$_SESSION['logout'] = "Du logga ut.";
	header ("location: login.php");
	}

}	
?>


</div>

	
</div>
</div>
</div> 
</div>
</body>
</html>
 
