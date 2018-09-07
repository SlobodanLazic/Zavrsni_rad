<?php
	
	class AlbumBM
	{
		private $id_album;
		private $name;
		private $releaseyear;
		private $cover;
		private $id_album_type;
		private $type_name;
		private $price;
		
		
		public function SetNewAlbum($name, $releaseyear, $cover, $id_album_type, $price)
		{
			$this->name = $name;
			$this->releaseyear = $releaseyear;
			$this->cover = $cover;
			$this->id_album_type = $id_album_type;
			$this->price = $price;
		}
		
		public function Getid_album()
		{
			return $this->id_album;
		}
		
		public function Getname()
		{
			return $this->name;
		}
		
		public function Getreleaseyear()
		{
			return $this->releaseyear;
		}
		
		public function Getcover()
		{
			return $this->cover;
		}
		
		public function Getid_album_type()
		{
			return $this->id_album_type;
		}
		
		public function Gettype_name()
		{
			return $this->type_name;
		}
		
		public function Getprice()
		{
			return $this->price;
		}
		
		public function LoadAlbumFromDB($id_album, $name, $releaseyear, $cover, $id_album_type, $type_name,$price)
		{
			$this->id_album = $id_album;
			$this->name = $name;
			$this->releaseyear = $releaseyear;
			$this->cover = $cover;
			$this->id_album_type = $id_album_type;
			$this->type_name = $type_name;
			$this->price = $price;
		}
	}
?>