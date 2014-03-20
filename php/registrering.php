<?php session_start();
// Henter inn require filer
require "config.php";
require "student.php";
require "sikkerhetskode.php";
unset($_SESSION['side']);
?>

<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/style.css">

		<!-- Hører til registrering -->

		<script>
			function giveFeedback(str) {
				if (str.length == 0) {
					document.getElementById("txtUserName").innerHTML = "";
					return;
				}
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("txtUserName").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET", "process_check_username.php?q=" + str, true);
				xmlhttp.send();
			}
		</script>

	</head>
	<body>

		<div id="container">

			<div id="mainContent">

				<h3>Registreringsskjema</h3>

				<form action="registrering.php" method="post">
					<h1>Registreringskode : </h1>
					<input name="RegKode" type="text" id="reg1">
					
					<h1>BrukerNavn 		  : </h1>
					<input pattern=".{3,12}" required title="Skriv inn brukernavn og passord" name="BrukerNavn" type="text" onkeyup="giveFeedback(this.value)" id="reg1">
					<span id="txtUserName"></span>
			
					<h1>Passord 	      : </h1>
					<input pattern=".{3,}" required title="Skriv inn brukernavn og passord" name="Passord" type="password" id="reg1">
					
					<h1>ForNavn 	      : </h1>
					<input pattern=".{0,30}" required title="Maks 30 bokstaver" name="ForNavn" type="text" id="reg1">
				
					<h1>EtterNavn  	      : </h1>
					<input pattern=".{0,30}" required title="Maks 30 bokstaver" name="EtterNavn" type="text" id="reg1">
				
					<h1>Adresse           : </h1>
					<input pattern=".{0,30}" required title="Maks 30 bokstaver" name="Adresse" type="text" id="reg1">
				
					<h1>PostNr    	      : </h1>
					<input pattern=".{0,30}" required title="Maks 30 bokstaver" name="PostNr" type="text" id="reg1">
		
					<h1>Telefon           : </h1>
					<input pattern=".{0,30}" required title="Maks 30 bokstaver" name="Telefon" type="text" id="reg1">
			
					<h1>Epost      	      : </h1>
					<input pattern=".{0,30}" required title="Maks 30 bokstaver" name="Epost" type="text" id="reg1">
		
					<h1>StudieRetning_ID  : </h1>
					<select name="studieretninger" id="dropDown">

						<!-- NITH -->
						<option value="1">Intelligente Systemer</option>
						<option value="2">Mobil Apputvikling</option>
						<option value="3">Programmering</option>
						<option value="4">Spillprogrammering</option>
						<option value="5">Spilldesign</option>
						<option value="6">3D-Grafikk</option>
						<option value="7">Interaktiv Design</option>
						<option value="8">E-Business</option>
						<option value="9">Industribachelor</option>
						<!-- NISS -->
						<option value="10">Lydproduksjon</option>
						<option value="11">Popul�rmusikk</option>
						<option value="12">NISS - Film og TV</option>
						<option value="13">Visuell Kunst</option>
						<option value="14">DIPLOMSTUDIER</option>
						<option value="15">Skuespillkunst</option>
						<option value="16">Lys og Scene</option>
						<option value="17">Prosjektledelse Kultur</option>
						<option value="18">FAGSKOLESTUDIER</option>
						<option value="19">Makeup</option>
						<option value="20">Spesialeffekter</option>
						<option value="21">KURS - NISS</option>

						<!-- Westerdals -->
						<option value="22">Art Direction</option>
						<option value="23">Excperience and Event</option>
						<option value="24">Westerdals - Film og TV</option>
						<option value="25">Grafisk Design</option>
						<option value="26">Retail Design</option>
						<option value="27">Tekst og Skribent</option>
						<option value="28">Kurs og Etterutdanning</option>
					</select>

					<input type="submit" id="submit3">
				</form>
				<!-- Knapper -->
				<br>
				<a href="login.php">Startside</a>
				<br>
				<a href="innlogget.php">Studentutvalg</a>

				<?php

				$student = new Student($database);
				$kode = new SikkerhetsKode($database);

				// Sjekker at Fornavn, Etternavn og passord ikke er tomme. Dette kan vi endre p� seinere.
				// N�r bruker trykker Send, s� blir et nytt objekt i student klassen oppretta, og lagt inn i en database.

				if ((!empty($_POST['ForNavn'])) && (!empty($_POST['EtterNavn'])) && (!empty($_POST['Passord']) && (!empty($_POST['RegKode'])))) {

					$koden = $kode -> getSikkerhetsKode("Student");

					if ($koden == $_POST['RegKode']) {
						// Sjekker om brukerNavn finnes fra.
						if (!$student -> checkIfUserExist($_POST['BrukerNavn'])) {

							//$userName, 		$userPass, 			$navn, 				$etterNavn, 		$adresse, 			$postNr, 		$tlf, 				$epost, 			$sRetning
							$student -> signUp($_POST['BrukerNavn'], $_POST['Passord'], $_POST['ForNavn'], $_POST['EtterNavn'], $_POST['Adresse'], $_POST['PostNr'], $_POST['Telefon'], $_POST['Epost'], $_POST['studieretninger']);

							// Blir automatisk sendt videre til login skjermen viss bruker blir oppretta
							$_SESSION['nyBruker'] = "Bruker er registrert.";
							header("location: login.php");

						} else {
							// Melding som kommer opp p� skjermen viss bruker finnes fra f�r
							echo "Bruker finnes fra før lol";
						}
					}
					echo "Feil kode..";
				}
				?>

				<!-- Hører til registrering ferdig -->
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
			<div id="kimWrap"></div>
			<div id="headerContent">

				<!-- Melding som kommer når du skriver feil innlogging. Skal stå på toppen av siden og med rød tekst -->
				<div id="wrapKim">
					<div id="warning">
						<?php
						if (isset($_SESSION['feilLogin'])) {
							echo $_SESSION['feilLogin'];
							unset($_SESSION['feilLogin']);
						}
						?>
					</div>

					
				</div>

				<div id="logo">
					<a href="../php/login.php" ><img src="../bilder/westerdalslogo.png">
					<div id="headerMenu">
						<div id="img1">

							<!-- 	Sjekker om du er innlogga. Er du det, så går MinSide knappen til Min Side.
							Er du IKKE innlogga, så går knappen til Registreringssiden. -->

							<?php
if(isset($_SESSION['BrukerNavn'])){
							?>
							<a href="../php/minside.php" > <?php
							}else{
							?> <a href="../php/registrering.php" > <?php
							}
							?> <img src="../bilder/minside.png"
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
							<input pattern=".{1,}" required title="Username/password" name="BrukerNavn" id="bruker" type="text" placeholder="Brukernavn"> <br>
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
							<a href="minSide.php">Min Side</a>

							<!-- Logg ut knapp -->
							<form method="post" action="">
							<p><button type="submit" name="logout">Logout</button></p>
							</form>

							<?php
							if (isset($_POST['logout'])) {
								unset($_SESSION['BrukerNavn']);
								$_SESSION['logout'] = "Du logga ut.";
								header("location: login.php");
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

