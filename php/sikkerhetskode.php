<?php
	
	class Sikkerhetskode{
		// classe variabler
		private $pdo_connection;
		
		public function __construct($database){
			$this->pdo_connection = $database;
		}
		
		
		// Returnerer sikkerhetskode basert på hvilken sikkerhetstype
		public function getSikkerhetsKode($type){
			 $sql = $this->pdo_connection->prepare("SELECT SikkerhetsKode from Sikkerhet where SikkerhetsType = :type;");
			 $sql->setFetchMode(PDO::FETCH_OBJ);
			 $sql->execute(array(':type' => $type));
			 
			 while($data = $sql->fetch()){
				$kode = $data->SikkerhetsKode;
				return $kode;
			}
		}
	}
	
?>