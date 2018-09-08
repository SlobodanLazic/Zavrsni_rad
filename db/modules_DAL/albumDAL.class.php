<?php
	include_once "db/classes_DM/typeDM.class.php";
	include_once "db/db.class.php";
	include_once "db/classes_DM/albumDM.class.php";
	
	class AlbumDAL
	{
		public function GetAlbumTypes()
		{
			$query = " 	SELECT 
							ta.ID_TIP_ALBUMA,
							ta.NAZIV,
							ta.OPIS
						FROM
							TIP_ALBUMA ta";
							
			$typesResult = DBConnection::Select($query);
			
			if ($typesResult != null && is_array($typesResult) && count($typesResult) > 0)
			{
				foreach($typesResult as $typeResult)
				{
					$type = new TypeDM();
					$type->SetAlbumType( $typeResult["ID_TIP_ALBUMA"],
										 $typeResult["NAZIV"],
										 $typeResult["OPIS"]
							);
							$types[] = $type;
				}
			}
			
			return isset($types) ? $types : null;
		}
		
		public function DeleteAlbumFromDB($albumDM)
		{
			$query = "	
					DELETE FROM ALBUM
					WHERE ID_ALBUMA = ?
					";
				
			$id_album = $albumDM->GetID_ALBUMA();
			$params[] = "i";
			$params[] = &$id_album;
			
			$userResult = DBConnection::DeletingById($query, $params);
			
			switch($userResult)
			{
				case -1:
					$errorLogMsg = "The query has returned an error." . PHP_EOL;
					break;
				case 0:
					$errorLogMsg = "No records where updated for an UPDATE/DELETE statement, 
					no rows matched the WHERE clause in the query or that no query has yet been executed."  . PHP_EOL;
					break;
				case null:
					$errorLogMsg = "Invalid argument was supplied to the function"  . PHP_EOL;
					break;
				default:
					$errorLogMsg = "";
			}
			if ($errorLogMsg != "")
			{
				error_log($errorLogMsg, 3,"db/error_log.txt");
			}
			
			return isset($errorLogMsg) ? $errorLogMsg : "";
		}
		
		public function InsertNewAlbum($albumDM)
		{
			$query = "	
						INSERT INTO ALBUM (NAZIV, GODINA_IZDAVANJA, OMOT, ID_TIP_ALBUMA, CENA)
						VALUES (?, ?, ?, ?, ?)
					";
					
			$name = $albumDM->GetNAZIV();
			$year = $albumDM->GetGODINA_IZDAVANJA();
			$cover = $albumDM->GetOMOT();
			$type = $albumDM->GetID_TIP_ALBUMA();
			$price = $albumDM->GetCENA();
			
			$params[] = "sssii";
			$params[] = &$name;
			$params[] = &$year;
			$params[] = &$cover;
			$params[] = &$type;
			$params[] = &$price;
			
			$resultArray = DBConnection::Insert($query, $params);
			
			$id = -1;
			if (isset($resultArray) && $resultArray != null)
			{
				if (count($resultArray) == 1)
				{
					$id = $resultArray["insert_id"];
				}
				else if (count($resultArray) == 2)
				{
					$errorMsg = date("Y-m-d H:i:s") . " " . $resultArray["error"] . PHP_EOL;
					error_log($errorMsg, 3, "db/error_log.txt");
				}
			}
			
			return $id;
		}
		
		public function GetAllAlbums()
		{
			$query = "	
						SELECT 
							a.ID_ALBUMA,
							a.NAZIV,
							a.GODINA_IZDAVANJA,
							a.OMOT,
							a.ID_TIP_ALBUMA,
							a.CENA
						FROM ALBUM a;
					";
					
			$albumsResult = DBConnection::Select($query);
			
			if ($albumsResult != null && is_array($albumsResult) && count($albumsResult) > 0)
			{
				foreach($albumsResult as $albumResult)
				{
					$albumDM = new AlbumDM();
					$albumDM->LoadAlbum(  
											$albumResult["ID_ALBUMA"],
											$albumResult["NAZIV"],
											$albumResult["GODINA_IZDAVANJA"],
											$albumResult["OMOT"],
											$albumResult["ID_TIP_ALBUMA"],
											$albumResult["CENA"]
										);
					$albums[] = $albumDM;					
				}
			}
			
			return ISSET($albums) ? $albums : null;
		}
	}
?>