<?php
	
	include_once "db/classes_DM/userDM.class.php";
	include_once "db/db.class.php";
	
	class UserDAL
	{
		public function GetUser($username,$password)
		{	
			$query =	"	SELECT 
									k.ID_KORISNIK,
									k.USERNAME,
									k.PASSWORD,
									k.EMAIL,
									k.POSLEDNJE_LOGOVANJE,
									k.ID_ROLA,
									k.ID_STATUS
								FROM 
									KORISNIK k
								WHERE
									k.USERNAME = ?
						";
						
			$params[] = "s";
			$params[] = &$username;	
				
			$userResult = DBConnection::SelectWithPrepared($query, $params);
			
			$validatePassword = (password_verify($password,$userResult[0]["PASSWORD"]));
			
			if ($userResult != null && is_array($userResult) && count($userResult) == 1 && $validatePassword == true)
			{
				$user = new UserDM();
				$userArray = $userResult[0];
				
				
				$user->SetUser(	$userArray["ID_KORISNIK"],	
								$userArray["USERNAME"],
								$userArray["PASSWORD"],
								$userArray["EMAIL"],
								$userArray["POSLEDNJE_LOGOVANJE"],
								$userArray["ID_ROLA"],
								$userArray["ID_STATUS"]
								);
				
			}
			
			return isset($user) ? $user : null;
		}
		
		public function RegisterUser($id_user, $username, $password, $email, $last_login_time, $id_role, $id_status)
		{
			$query = "	
						INSERT INTO KORISNIK (ID_KORISNIK, USERNAME, PASSWORD, EMAIL, POSLEDNJE_LOGOVANJE, ID_ROLA, ID_STATUS)
						VALUES (?, ?, ?, ?, ?, ?, ?)
					";
					
			
			$params[] = "issssii";
			$params[] = &$id_user;
			$params[] = &$username;
			$params[] = &$password;
			$params[] = &$email;
			$params[] = &$last_login_time;
			$params[] = &$id_role;
			$params[] = &$id_status;
			
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
		
		public function UpdateLastLoginTime($userID)
		{
			$query = "	UPDATE KORISNIK	k
								SET k.POSLEDNJE_LOGOVANJE = CURRENT_TIMESTAMP
								WHERE k.ID_KORISNIK = ?
			";
			$id = $userID;
			$params[] = "i";
			$params[] = &$id;
			$userResult = DBConnection::Update($query,$params);
			
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
			
		}
	}
?>