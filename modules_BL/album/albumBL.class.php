<?php
	include_once ("modules_BL/album/typeBL.class.php");
	include_once ("classes_BM/albumBM.class.php");
	include_once ("db/classes_DM/albumDM.class.php");
	include_once ("db/modules_DAL/albumDAL.class.php");
	
	class AlbumBL
	{
		public function InsertNewAlbum()
		{
			$albmName = trim($_POST["albmName"]);
			$rlsYear = trim($_POST["rlsYear"]);
			$id_album_type = trim($_POST["id_album_type"]);
			$price = trim($_POST["price"]);
			
			$albmName = htmlspecialchars($albmName);
			$rlsYear = htmlspecialchars($rlsYear);
			$id_album_type = htmlspecialchars($id_album_type);
			$price = htmlspecialchars($price);
			
			$albmName = stripslashes($albmName);
			$rlsYear = stripslashes($rlsYear);
			$id_album_type = stripslashes($id_album_type);
			$price = stripslashes($price);
			
			if($albmName != "" && $rlsYear != "" && $id_album_type != "" && $_FILES["albmCover"]["error"] == 0 && $price != 0)
			{
				$allowedExts = array("jpg", "jpeg", "gif", "png");
				$explodedArray = explode(".",$_FILES["albmCover"]["name"]);
				$extension = end($explodedArray);
				$allowedTypes = array("image/gif", "image/jpeg" , "image/png" ,"image/pjpeg");
				$imageType = $_FILES["albmCover"]["type"];
			
				if( 
					in_array($extension, $allowedExts) 
					&& in_array($imageType, $allowedTypes) 
					&& $_FILES["albmCover"]["size"] < 2 * 1024 * 1024
					)//2MB//
				{
					$albumBM = new AlbumBM();
					$albumBM->SetNewAlbum($albmName, $rlsYear, $_FILES["albmCover"]["name"], $id_album_type,$price);
					
					$albumDM = $this->MapAlbumBM2DM($albumBM);
					
					$albumDAL = new AlbumDAL();
					
					$id = $albumDAL->InsertNewAlbum($albumDM);
					
					if($id == -1)
					{
						printf("An error has occured!!!");
					}
					else
					{	
						$imageFolderPath = sprintf("images/albums/%d", $id);
						mkdir($imageFolderPath);
						
						$filePath = sprintf("%s/%s", $imageFolderPath, $_FILES["albmCover"]["name"]);
						move_uploaded_file($_FILES["albmCover"]["tmp_name"],$filePath);
					}
					
				}	
			}						
		}
		
		public function DeleteAlbum()
		{
			$post = json_encode($_POST["id_album"]);
				echo "<pre>";
				echo $post;
				echo "</pre>";
		}
		
		public function GetAlbums()
		{
			$albumDAL = new AlbumDAL();
			$albumsDM = $albumDAL->GetAllAlbums();
			
			$albums = $this->MapAlbumDM2BM($albumsDM);
			
			return $albums;
			
		}
		
		
		private function MapAlbumDM2BM($albumsDM)
		{
			if(ISSET($albumsDM) && $albumsDM != null && count($albumsDM) > 0)
			{
				$typeBL = new TypeBL();
				$types = $typeBL->GetTypes();
				
				foreach ($types as $type)
				{
					$typestoLoad[$type->GetId_album_type()] = $type->GetName();
				}
				
				foreach($albumsDM as $albumDM)
				{
					$albumBM = new AlbumBM();
					$albumBM->LoadAlbumFromDB(	$albumDM->GetID_ALBUMA(),
												$albumDM->GetNAZIV(),
												$albumDM->GetGODINA_IZDAVANJA(),
												$albumDM->GetOMOT(),
												$albumDM->GetID_TIP_ALBUMA(),
												$typestoLoad[$albumDM->GetID_TIP_ALBUMA()],
												$albumDM->GetCENA()											
												);
												
					$albums[] = $albumBM;
				}
			}
			
			return ISSET($albums) ? $albums : null;
		}
		
		private function MapAlbumBM2DM($albumBM)
		{
			$albumDM = new AlbumDM();
			$albumDM->LoadAlbum(null,
									$albumBM->Getname(), 
									$albumBM->Getreleaseyear(), 
									$albumBM->Getcover(),									
									$albumBM->Getid_album_type(),
									$albumBM->Getprice()
								);
				return $albumDM;
		}
	}
?>