<?php 

	class Student{
		// Classe variabler
		private $pdo_connection;
		private $signInStatus;

		// Konstrukt�r for student classen
		public function __construct($database){
			$this->pdo_connection = $database;
			$this->signInStatus = false;
		}


		// Student logg inn
		public function signIn($userName, $password){
			// Sjekker om brukernavnet er riktig f�r innlogging prossesen
			if($this->checkIfUserExist($userName)){
				$sql = $this->pdo_connection->prepare("SELECT BrukerPass from Student where BrukerNavn = :in;");
				$sql->setFetchMode(PDO::FETCH_OBJ);
				$sql->execute(array('in' => $userName));
				$data = $sql->fetch();
				// Hvis passorder stemmer med det som er i databasen
				if($password == $data->BrukerPass){
					echo '<br/>'. "Korrekt innlogging!";
					$this->signInStatus = true;
					header ("location: minSide.php");
				}else{
					echo '<br/>'. "Falsk innlogging";
				}		
			}else{
				echo '<br/>'. "Falsk innlogging";
			}
		}


		// Student logg ut
		public function signOut(){
			$this->signInStatus = false;
		}


		// Sjekk om bruker er logget inn
		public function getIsSignedIn(){
			return $this->signInStatus;
		}


		// registrering av bruker
		public function signUp($userName, $userPass, $navn, $etterNavn, $adresse, $postNr, $tlf, $epost, $sRetning){
			// hvis bruker ikke eksisterer fra f�r, denne m� ikke v�re sann
			if(!$this->checkIfUserExist($userName)){
				 // Legger til ny bruker med userName og passWord
				 $sql = $this->pdo_connection->prepare("INSERT INTO Student VALUES(null, :bNavn, :bPass, :sNavn, :sEtterNavn, :adresse, :postNr, :tlf, :epost, :sRetning)");
				// $sql->setFetchMode(PDO::FETCH_OBJ);
				 $sql->execute(array('bNavn' => $userName, 'bPass' => $userPass, 'sNavn' => $navn, 'sEtterNavn' => $etterNavn, 'adresse' => $adresse, 
				 					 'postNr' => $postNr, 'tlf' => $tlf, 'epost' => $epost, 'sRetning' => $sRetning));
			}else{
				// Brukernavnet er tatt i bruk!	
				echo "Bruker finnes allerede i databasen". '<br/>';
			}
		}


		// Sjekker om bruker ekstirerer i det hele tatt
		public function checkIfUserExist($userName){
		     $sql = $this->pdo_connection->prepare("SELECT * FROM Student where BrukerNavn = :in;");
			 $sql->setFetchMode(PDO::FETCH_OBJ);
			 $sql->execute(array('in' => $userName));
			 // Teller opp antall rader 
			 $count = $sql->rowCount();

			 // er den = 0 så eksisterer ikke bruker
			 if($count == 0){
			 	return false;	
			 }else{
			 	return true;	
			 }
		}


		// Hent studentpass baset på userName
		public function getStudentPassord($userName){
			$sql = $this->pdo_connection->prepare("select BrukerPass from Student where BrukerNavn = :a;");
			$sql->setFetchMode(PDO::FETCH_OBJ);
			$sql->execute(array('a' => $userName));
			
			while($data = $sql->fetch()){
				$passord = $data->BrukerPass;
				return $passord;
			}
		}


		// Hent all bruker data
		public function getStudentInfo($userName){
			// Sjekker om brukeren eksisterer f�r man g�r videre
			if($this->checkIfUserExist($userName)){
			$sql = $this->pdo_connection->prepare("select * from Student where BrukerNavn = :a;");
			$sql->setFetchMode(PDO::FETCH_OBJ);
			$sql->execute(array('a' => $userName));

			// Printer ut all data fra student tabellen basert p� bruknavnet
			while($data = $sql->fetch()){
				echo $data->BrukerNavn. '<br/>';
				echo $data->ForNavn. '<br/>';
				echo $data->EtterNavn. '<br/>';
				echo $data->Adresse. '<br/>';
				echo $data->PostNr. '<br/>';
				echo $data->Telefon. '<br/>';
				echo $data->Epost. '<br/>';
				echo $data->StudieRetning_ID. '<br/>';
				}
			}else{
				echo "Dette brukernavnet: " . $userName . " ble ikke funnet i databasen.";
			}
		}
		
		
		// Printer ut alle studenter i databasen, mest for å vise hvordan denne dataen kan bli brukt og layouta 
		public function getAllStudents(){
				$sql = $this->pdo_connection->prepare("select * from Student");
				$sql->setFetchMode(PDO::FETCH_OBJ);
				$sql->execute();
				
				while($data = $sql->fetch()){
					echo "<div id=infoboks>";
						echo "<h1>". $data->BrukerNavn. "</h1>". '<br/>';
						echo "<div id=innhold>";
							echo $data->ForNavn. '<br/>';
							echo $data->EtterNavn. '<br/>';
							echo $data->Adresse. '<br/>';
							echo $data->PostNr. '<br/>';
							echo $data->Telefon. '<br/>';
							echo $data->Epost. '<br/>';
							echo $data->StudieRetning_ID. '<br/>';
							// Denne er for øyeblikket mest for test(Blir nok fjernet)
							echo "<form action=\"\" method=\"post\">
								<input type=\"submit\" name=\"input$data->Student_ID\"  value=\"$data->ForNavn\">
								</form>";
						echo "</div>";	
					echo "</div>";
					}
			}
			
			// Henter ut alle student ider
			public function getAllId(){
				$sql = $this->pdo_connection->prepare("select Student_ID from Student;");
				$sql->setFetchMode(PDO::FETCH_OBJ);
				$sql->execute();
					
				$studentArray = array();
										
				// Printer ut all data fra student tabellen basert p� bruknavnet
				while($data = $sql->fetch()){
					array_push($studentArray,
					 $data->Student_ID);
					}
				return $studentArray;
			}
			
			// Gir student mulighet til å sette nytt passord!
			public function updateStudentPass($brukernavn, $gammeltBP, $nyttBP){
				$sql = $this->pdo_connection->prepare("UPDATE Student
													   set BrukerPass = :nyttBP
													   where BrukerNavn = :brukerNavn
													   and BrukerPass = :gammeltBP;");
				$sql->setFetchMode(PDO::FETCH_OBJ);
				$sql->execute(array('brukerNavn' => $brukernavn, 'gammeltBP' => $gammeltBP, 'nyttBP' => $nyttBP));
				$count = $sql->rowCount();
				if($count > 0){
					return "Succesfull";
				}else{
					return "Failed";
				}
			}
			
			
			// Gir student mulighet til å bytte epost
			public function updateStudentEpost($brukernavn, $nyEpost){
				$sql = $this->pdo_connection->prepare("UPDATE Student
													   set Epost = :nyEpost	
													   where BrukerNavn = :brukerNavn");
				$sql->setFetchMode(PDO::FETCH_OBJ);
				$sql->execute(array('brukerNavn' => $brukernavn, 'nyEpost' => $nyEpost));
				$count = $sql->rowCount();
				if($count > 0){
					return "Succesfull";
				}else{
					return "Failed";
				}
			}
			
		}

?>