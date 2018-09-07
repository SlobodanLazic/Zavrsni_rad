<?php
	
	class AlbumDM
	{
		private $ID_ALBUMA;
		private $NAZIV;
		private $GODINA_IZDAVANJA;
		private $OMOT;
		private $ID_TIP_ALBUMA;
		private $CENA;
		
		public function LoadAlbum($ID_ALBUMA, $NAZIV, $GODINA_IZDAVANJA, $OMOT, $ID_TIP_ALBUMA,$CENA)
		{
			$this->ID_ALBUMA = $ID_ALBUMA;
			$this->NAZIV = $NAZIV;
			$this->GODINA_IZDAVANJA = $GODINA_IZDAVANJA;
			$this->OMOT = $OMOT;
			$this->ID_TIP_ALBUMA = $ID_TIP_ALBUMA;
			$this->CENA = $CENA;
		}
		
		public function GetID_ALBUMA()
		{
			return $this->ID_ALBUMA;
		}
		
		public function GetNAZIV()
		{
			return $this->NAZIV;
		}
		
		public function GetGODINA_IZDAVANJA()
		{
			return $this->GODINA_IZDAVANJA;
		}
		
		public function GetOMOT()
		{
			return $this->OMOT;
		}
		
		public function GetID_TIP_ALBUMA()
		{
			return $this->ID_TIP_ALBUMA;
		}
		
		public function GetCENA()
		{
			return $this->CENA;
		}
	}	
?>