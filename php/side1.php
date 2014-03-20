<?php session_start(); ?>

<html>
	<head>
		<meta charset="utf-8"> 
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		
		<h1>Dette er en test side</h1>
		
		
<?php
	
	// Henter BrukerNavn og Passord fra index2.php	
	echo "Velkommen ". $_SESSION['BrukerNavn'];
	
?>

<br>
<a href="registrering.php">Forste side</a>
<br>
<a href="login.php">Andre side</a>

</form>
</body>
</html>