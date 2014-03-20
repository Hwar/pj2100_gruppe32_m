<?php 
	
	
	class Utvalg{
		// Utvalg variabler	
		private $pdo_connection;
		
		public function __construct($database){
			$this->pdo_connection = $database;
		}
		
		// Hent alle idene til utvalgene som er registrert i databasen
		public function getAllUtvalgId(){
			$sql = $this->pdo_connection->prepare("SELECT Utvalg_ID FROM Utvalg");
			$sql->setFetchMode(PDO::FETCH_OBJ);
			$sql->execute();
			
			$idArray = array();
			while($data = $sql->fetch()){
				// Pusher utvalg_id inn til idArray
				array_push($idArray, $data->Utvalg_ID);
			}
			// Returnerer en array av Utvalg_ID
			return $idArray;
		}
		
		
		// Henter alle utvalgene i databasen
		public function getAllUtvalg(){
			$sql = $this->pdo_connection->prepare("select * from Utvalg");
			$sql->setFetchMode(PDO::FETCH_OBJ);
			$sql->execute();
				
			while($data = $sql->fetch()){

				echo "<div id=infoboks>";
					echo "<div id=boks$data->Utvalg_ID>";
					echo "<div id=banner>";
					echo "<h1>". $data->UtvalgNavn. "</h1>". '<br/>';
					echo "</div>";
					echo "</div>";
					echo "<div id=innhold>";
					echo $data->UtvalgInfo. '<br/>';
					if(isset($_SESSION['BrukerNavn'])){
						echo "<form action=\"process_utvalginn.php\" method=\"post\">
								<input type=\"submit\" name=\"input$data->Utvalg_ID\"  value=\"Bli med\">
								</form>";
					}
						echo "</div>";	
					echo "</div>";
					}
		}
		
		// Henter 1 utvalg basert på utvalges id (bruker for øyeblikket ikke!)
		public function getUtvalgOnId($id){
			$sql = $this->pdo_connection->prepare("select * from Utvalg where Utvalg_ID = :id");
			$sql->setFetchMode(PDO::FETCH_OBJ);
			$sql->execute(array('id' => $id));
				
			while($data = $sql->fetch()){
				echo "<div id=infoboks>";
					echo "<h1>". $data->UtvalgNavn. "</h1>". '<br/>';
					echo "<div id=innhold>";
					echo $data->UtvalgInfo. '<br/>';
					if(isset($_SESSION['BrukerNavn'])){
						echo "<form action=\"process_utvalginn.php\" method=\"post\">
								<input type=\"submit\" name=\"input$data->Utvalg_ID\"  value=\"Bli med\">
								</form>";
					}
						echo "</div>";	
					echo "</div>";
					}
		}
		
		
		// Henter hvilket utvalg en student er med i
		public function getUtvalgOntudent($brukerNavn){
			$sql = $this->pdo_connection->prepare("Select Utvalg.Utvalg_ID, Utvalg.UtvalgNavn from Student
												   JOIN StudentIUtvalg on Student.Student_ID = StudentIUtvalg.Student_ID
												   JOIN Utvalg on StudentIUtvalg.Utvalg_ID = Utvalg.Utvalg_ID
												   where Student.BrukerNavn = :in;");
			$sql->setFetchMode(PDO::FETCH_OBJ);
			$sql->execute(array('in' => $brukerNavn));
			
			echo "<form action='process_utvalgut.php' method='post'>";
			echo "<select name='utvalg'>";
			while($data = $sql->fetch()){
				echo $data->UtvalgNavn .'<br/>'; 
				echo "<option value=$data->Utvalg_ID> $data->UtvalgNavn</option>";
			}
			echo "</select>";
			echo "<input type=\"submit\" name=\"btnMeldUt\"  value=\"Meld ut\">
			</form>";
			
		}
		
		
		// Hent navnet på et utvalg
		public function getUtvalgNameById($id){
			$sql = $this->pdo_connection->prepare("select UtvalgNavn from Utvalg where Utvalg_ID = :id");
			$sql->setFetchMode(PDO::FETCH_OBJ);
			$sql->execute(array('id' => $id));
				
			while($data = $sql->fetch()){
				$navn = $data->UtvalgNavn;
				return $navn;
			}	
		}
		
		// Meld student inn i et utvalg basert på brukernavn/utvalg trykker på
		public function meldInnStudent($brukerNavn, $utvalg){
			$sql = $this->pdo_connection->prepare("SELECT Student_ID from Student where BrukerNavn = :in;");
			$sql->setFetchMode(PDO::FETCH_OBJ);
			$sql->execute(array('in' => $brukerNavn));
			$data = $sql->fetch();
			$id = $data->Student_ID;
			
			$sql = $this->pdo_connection->prepare("INSERT INTO StudentIUtvalg VALUES(:s_ID,:u_ID);");
			$sql->setFetchMode(PDO::FETCH_OBJ);
			$sql->execute(array('s_ID' => $id, 'u_ID' => $utvalg,));
			$count = $sql->rowCount();
			if($count > 0){
					return true;
			}else{
					return false;
			}
		}
				
		
		// MeldUtStudent fra gitt utvalg basert på brukernavn
		public function meldUtStudent($brukerNavn, $utvalg){
			$sql = $this->pdo_connection->prepare("SELECT Student_ID from Student where BrukerNavn = :in;");
			$sql->setFetchMode(PDO::FETCH_OBJ);
			$sql->execute(array('in' => $brukerNavn));
			$data = $sql->fetch();
			$id = $data->Student_ID;
			
			$sql = $this->pdo_connection->prepare("Delete from StudentIUtvalg where Utvalg_ID = :u_ID and Student_ID = :s_ID;");
			$sql->setFetchMode(PDO::FETCH_OBJ);
			$sql->execute(array('u_ID' => $utvalg, 's_ID' => $id));
		}
		
		
		// Administrator brukere har mulighet til å opprette et nytt utvalg	
		public function opprettUtvalg($navn, $info){
			$sql = $this->pdo_connection->prepare("INSERT INTO Utvalg Values(null, :UtvalgNavn, :UtvalgInfo);");
			$sql->setFetchMode(PDO::FETCH_OBJ);
			$sql->execute(array('UtvalgNavn' => $navn, 'UtvalgInfo' => $info));
			$count = $sql->rowCount();
			if($count > 0){
					return true;
			}else{
					return false;
			}
		}
		
	}

?>