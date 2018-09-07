<?php
	include_once ("db/modules_DAL/albumDAL.class.php");
	include_once ("db/classes_DM/typeDM.class.php");
	include_once ("classes_BM/typeBM.class.php");
	
	class TypeBL
	{
		public function GetTypes()
		{
			$typeDAL = new AlbumDAL();
			$typesDM = $typeDAL->GetAlbumTypes();
			
			$types = $this->MapTypesDM2BM($typesDM);
			
			return $types;
		}
		
		private function MapTypesDM2BM($typesDM)
		{
			if ($typesDM != null && is_array($typesDM) && count($typesDM) > 0)
			{
				foreach($typesDM as $typeDM)
				{
					$typeBM = new TypeBM();
					$typeBM->SetAlbumType(  
											$typeDM->GetID_TIP_ALBUMA(),
											$typeDM->GetNAZIV(),
											$typeDM->GetOPIS()
										);
					$types[] = $typeBM;					
				}
			}
			
			return ISSET($types) ? $types : null;
		}
	}
?>