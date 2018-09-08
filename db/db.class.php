<?php
	require_once("util.php");
	
	class DBConnection
	{
		private static $conn;
		
		private static function setConnection()
		{
			self::$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
		}
		
		private static function closeConnection()
		{
			self::$conn->close();
		}
	
		public static function Select($query)
		{
			self::setConnection();
			
			$result = self::$conn->query($query);
			
			while ($row = $result->fetch_assoc())
			{
				$resultArray[] = $row;
			}
			
			self::closeConnection();
			
			return ISSET($resultArray) ? $resultArray : null;
		}
		
		public static function SelectWithPrepared($query,$params)
		{
			self::setConnection();
			
			$stmt = self::$conn->stmt_init();
			
			if(!$stmt->prepare($query))
			{
				$resultArray["errno"] = self::$conn->errno;
				$resultArray["error"] = self::$conn->error;
			}
			else
			{
				call_user_func_array(array($stmt, 'bind_param'), $params);
				$stmt->execute();
				$result = $stmt->get_result();
				if (self::$conn->errno > 0)
				{
					$resultArray["errno"] = self::$conn->errno;
					$resultArray["error"] = self::$conn->error;
				}
				else
				{
					while($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$resultArray[] = $row;
					}
				}
				$stmt->close();
			}
			
			self::closeConnection();
			
			return ISSET($resultArray) ? $resultArray : null;
		}
		
		public static function Insert($query,$params)
		{
			self::setConnection();
			
			$stmt = self::$conn->prepare($query);
			if($stmt === false)
			{
				$resultArray["errno"] = self::$conn->errno;
				$resultArray["error"] = self::$conn->error;
			}
			else
			{
				call_user_func_array(array($stmt, 'bind_param'), $params);
				$stmt->execute();
				
				if (self::$conn->errno > 0)
				{
					$resultArray["errno"] = self::$conn->errno;
					$resultArray["error"] = self::$conn->error;
				}
				else
				{
					$resultArray["insert_id"] = self::$conn->insert_id;
				}
				$stmt->close();
			}
			
			self::closeConnection();
			
			return ISSET($resultArray) ? $resultArray : null;
		}
		
		public static function Update($query,$params)
		{
			self::setConnection();
			
			$stmt = self::$conn->prepare($query);
			if($stmt === false)
			{
				$resultArray["errno"] = self::$conn->errno;
				$resultArray["error"] = self::$conn->error;
				
			}
			else
			{
				call_user_func_array(array($stmt, 'bind_param'), $params);
				$stmt->execute();
				
				if (self::$conn->errno > 0) 
				{
					$resultArray["errno"] = self::$conn->errno;
					$resultArray["error"] = self::$conn->error;
				}
				else
				{
					$resultArray["insert_id"] = self::$conn->insert_id;
					
				}
				$affectedRows = $stmt->affected_rows;
				$stmt->close();
			}
			
			self::closeConnection();
			
			return $affectedRows;
		}
		
		public static function DeletingById($query,$params)
		{
			self::setConnection();
			
			$stmt = self::$conn->prepare($query);
			if($stmt === false)
			{
				$resultArray["errno"] = self::$conn->errno;
				$resultArray["error"] = self::$conn->error;
				
			}
			else
			{
				call_user_func_array(array($stmt, 'bind_param'), $params);
				$stmt->execute();
				
				if (self::$conn->errno > 0) 
				{
					$resultArray["errno"] = self::$conn->errno;
					$resultArray["error"] = self::$conn->error;
				}
				else
				{
					$resultArray["insert_id"] = self::$conn->insert_id;
					
				}
				$affectedRows = $stmt->affected_rows;
				$stmt->close();
			}
			
			self::closeConnection();
			
			return $affectedRows;
		}
	}
?>