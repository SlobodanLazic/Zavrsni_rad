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
			
			if($albmName != "" && $rlsYear != "" && $id_album_type != "" && $_FILES["albmCover"]["error"] == 0 && $price != 0 
			&& is_numeric($rlsYear) && strlen($rlsYear) == 4)
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
					)
				{
					$albumBM = new AlbumBM();
					$albumBM->SetNewAlbum($albmName, $rlsYear, $_FILES["albmCover"]["name"], $id_album_type,$price);
					
					$albumDM = $this->MapAlbumBM2DM($albumBM);
					
					$albumDAL = new AlbumDAL();
					
					$id = $albumDAL->InsertNewAlbum($albumDM);
					
					$validationMsg = "";
					if($id == -1)
					{
						$validationMsg = "An error has occured!!!";
					}
					else
					{	
						$imageFolderPath = sprintf("images/albums/%d", $id);
						mkdir($imageFolderPath);
						
						$filePath = sprintf("%s/%s", $imageFolderPath, $_FILES["albmCover"]["name"]);
						move_uploaded_file($_FILES["albmCover"]["tmp_name"],$filePath);
						$validationMsg = "You have sucessfully added album!!!";
					}
					
					
					return $validationMsg;
				}	
			}						
		}
		
		public function BuyAlbum($albumBM,$user)
		{
			
			$adminEmail = "admin@admin.com";
			$subjectofEmail = "Album order";
			$id_album = $albumBM->Getid_album();
			$nameofAlbum = $albumBM->Getname();
			$yearofRelease = $albumBM->Getreleaseyear();
			$type_name = $albumBM->Gettype_name();
			$price = $albumBM->Getprice();
			$emailMsg = sprintf("
								<!DOCTYPE html>
								<html>
									<head>
									<meta charset='UTF-8'>
										<title>Album order</title>
									<link href='https://fonts.googleapis.com/css?family=Metal+Mania' rel='stylesheet'>
									<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css' integrity='sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU' crossorigin='anonymous'>
									<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
									<style>
									body {
										margin: 0;
										padding: 0;
										background: #000;
										font-family: 'Metal Mania', cursive, 'Roboto', Arial, sans-serif;
										font-size: 20px;
										color: #FFF;
									}
									#wrapper {
										border:1px solid #FFF;
										width:960px;
									}
									</style>
									</head>
									<body>
										<div id='wrapper'>
											<p>User with Username: %s and Email: %s wants to buy an album</p>
											<p>Identification number of album: %s</p>
											<p>Name: %s</p>
											<p>Year: %s</p>
											<p>Type: %s</p>
											<p>Price: %s &euro;</p>
											<p>Contact him via email as soon as possible!!!</p>
										</div>
									</body>
								</html>",
								$user->GetUSERNAME(), $user->GetEMAIL(),$id_album, $nameofAlbum, $yearofRelease, $type_name, $price);
			$emailResponse = @mail($adminEmail, $subjectofEmail, $emailMsg);
		}
		
		public function DeleteAlbum($albumBM)
		{	
		
			$albumDM = $this->MapAlbumBM2DM($albumBM);
			$albumDAL = new AlbumDAL();
			$errorMsg = $albumDAL->DeleteAlbumFromDB($albumDM);
			
			if ($errorMsg == "")
			{
				$imageFolderPath = sprintf("images/albums/%d", $albumBM->Getid_album());
				$imageFilePath = $imageFolderPath . "/" . $albumBM->Getcover();
				unlink($imageFilePath);
				rmdir($imageFolderPath);
				
				header("Location: delete.album.php");
				$validationMsg = "You have sucessfully deleted album!!!";
			}
			else if ($errorMsg != "")
			{
				$validationMsg = "An error has occured!";
			}
			else
			{
				$validationMsg = "";
			}
			
			return $validationMsg;
			
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
					$typestoLoad[$type->GetId_album_type()] = $type->GetName() . "," . $type->GetDescription();
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
			$albumDM->LoadAlbum(	$albumBM->Getid_album(),
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