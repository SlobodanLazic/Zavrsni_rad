<?php
	
	class TypeBM
	{
		private $id_album_type;
		private $name;
		private $description;
		
		public function SetId_album_type($id_album_type)
		{
			$this->id_album_type = $id_album_type;
		}
		
		public function SetName($name)
		{
			$this->name = $name;
		}
		
		public function SetDescription($description)
		{
			$this->description = $description;
		}
		
		public function GetId_album_type()
		{
			return $this->id_album_type;
		}
		
		public function GetName()
		{
			return $this->name;
		}
		
		public function GetDescription()
		{
			return $this->description;
		}
		
		public function SetAlbumType($id_album_type, $name, $description)
		{
			$this->id_album_type = $id_album_type;
			$this->name = $name;
			$this->description = $description;
		}
	}
?>