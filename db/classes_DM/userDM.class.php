<?php
	
	class UserDM
	{
		private $ID_KORISNIK;
		private $USERNAME;
		private $PASSWORD;
		private $EMAIL; 
		private $POSLEDNJE_LOGOVANJE;
		private $ID_ROLA;
		private $ID_STATUS;
		
		public function GetID_KORISNIK()
		{
			return $this->ID_KORISNIK;
		}
		
		public function GetUSERNAME()
		{
			return $this->USERNAME;
		}
		
		public function GetPASSWORD()
		{
			return $this->PASSWORD;
		}
		
		public function GetEMAIL()
		{
			return $this->EMAIL;
		}
		
		public function GetPOSLEDNJE_LOGOVANJE()
		{
			return $this->POSLEDNJE_LOGOVANJE;
		}
		
		public function GetID_ROLA()
		{
			return $this->ID_ROLA;
		}
		
		public function GetID_STATUS()
		{
			return $this->ID_STATUS;
		}
		
		public function SetID_KORISNIK($ID_KORISNIK)
		{
			$this->ID_KORISNIK = $ID_KORISNIK;
		}
		
		public function SetUSERNAME($USERNAME)
		{
			$this->USERNAME = $USERNAME;
		}
		
		public function SetPASSWORD($PASSWORD)
		{
			$this->PASSWORD = $PASSWORD;
		}
		
		public function SetEMAIL($EMAIL)
		{
			$this->EMAIL = $EMAIL;
		}
		
		public function SetPOSLEDNJE_LOGOVANJE($POSLEDNJE_LOGOVANJE)
		{
			$this->POSLEDNJE_LOGOVANJE = $POSLEDNJE_LOGOVANJE;
		}
		
		public function SetID_ROLA($ID_ROLA)
		{
			$this->ID_ROLA = $ID_ROLA;
		}
		
		public function SetID_STATUS($ID_STATUS)
		{
			$this->ID_STATUS = $ID_STATUS;
		}
		
		public function SetUser(
								$ID_KORISNIK,
								$USERNAME,
								$PASSWORD,
								$EMAIL,
								$POSLEDNJE_LOGOVANJE,
								$ID_ROLA,
								$ID_STATUS
		)		
		{
			$this->SetID_KORISNIK($ID_KORISNIK);
			$this->SetUSERNAME($USERNAME);
			$this->SetPASSWORD($PASSWORD);
			$this->SetEMAIL($EMAIL); 
			$this->SetPOSLEDNJE_LOGOVANJE($POSLEDNJE_LOGOVANJE);
			$this->SetID_ROLA($ID_ROLA);
			$this->SetID_STATUS($ID_STATUS);
		}
	}
?>