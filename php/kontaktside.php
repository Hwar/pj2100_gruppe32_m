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
			
			
			
			        <br>
			<!-- Overskrift til hvem som logger inn -->
		 <h1><?php echo "KONTAKT OSS"; ?></h1>
         
         <h3><?php echo "NISS NORDISK INSTITUTT FOR SCENE OG STUDIO"; ?></h3>
         <h4><?php echo "Christian Krohgs gt. 2, 0186 Oslo";?></h4>
         <h4><?php echo "Tlf:22 05 75 50";?></h4>
         <h4><?php echo "Epost:"?><a href="mailto:post@niss.no">post@niss.no</a></h4>
         <h4><?php echo "Kontortid: Mandag – fredag kl 08.30 – 16.00, torsdager stengt mellom 13.15 og 14.15";?></h4>
         
         <h3><?php echo "NITH - Norges Informasjonsteknologiske Høgskole AS"; ?></h3>
         <h4><?php echo "Schweigaardsgate 14, 0185 Oslo";?></h4>
         <h4><?php echo "Tlf:22 05 99 99";?></h4>
         <h4><?php echo "Studieadministrasjon:"?><a href="mailto:post@nith.no">oslo@nith.no</a></h4>
         <h4><?php echo "Opptakskontor:"?><a href="mailto:opptak@nith.no">opptak@nith.no</a></h4>
         <h4><?php echo "Kontortid: 09.00 - 11.30 og 12.00 - 15.00";?></h4>
         
         <h3><?php echo "Westerdals Høyskole AS"; ?></h3>
         <h4><?php echo "Maridalsveien 17D, 0178 Oslo";?></h4>
         <h4><?php echo "Tlf:22 99 97 50";?></h4>
         <h4><?php echo "Epost:"?><a href="mailto:post@westerdals.no">post@westerdals.no</a></h4>
         <h4><?php echo "Kontortid: Mandag – fredag fra klokken 08.00 – 22.00 (Studentvakt er tilstede fra 16.00 – 22.00)";?></h4>
         <h4><?php echo "			Lørdag fra klokken 10.00-18.00";?></h4>
         <h4><?php echo "			Søndag fra klokken 10.00 – 20.00.";?></h4>
         
		<br>

			
			
			
			
			
			
			
			
			
			
			
			
			
			

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
					<img src="../bilder/kontakt-rollover.png" </a>
				</div>
			</div>

		
<div id="loginWrap">
<div id="login">
	
<?php	
	

	

// Sjekker om noen IKKE er innlogga. Vil da få frem innlogging og passord
if(!(isset($_SESSION['BrukerNavn'])))	{
$_SESSION['side'] = "kontaktside.php";
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
	header ("location: kontaktside.php");
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
 
