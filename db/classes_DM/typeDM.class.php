<?php
	
	class TypeDM 
	{
		private $ID_TIP_ALBUMA;
		private $NAZIV;
		private $OPIS;
		
		public function SetID_TIP_ALBUMA($ID_TIP_ALBUMA)
		{
			$this->ID_TIP_ALBUMA = $ID_TIP_ALBUMA;
		}
		
		public function SetNAZIV($NAZIV)
		{
			$this->NAZIV = $NAZIV;
		}
		
		public function SetOPIS($OPIS)
		{
			$this->OPIS = $OPIS;
		}
		
		public function GetID_TIP_ALBUMA()
		{
			return $this->ID_TIP_ALBUMA;
		}
		
		public function GetNAZIV()
		{
			return $this->NAZIV;
		}
		
		public function GetOPIS()
		{
			return $this->OPIS;
		}
		
		public function SetAlbumType($ID_TIP_ALBUMA, $NAZIV, $OPIS)
		{
			$this->ID_TIP_ALBUMA = $ID_TIP_ALBUMA;
			$this->NAZIV = $NAZIV;
			$this->OPIS = $OPIS;
		}
		
	}
?>