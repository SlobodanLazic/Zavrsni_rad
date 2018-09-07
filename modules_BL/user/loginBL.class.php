<?php
	include_once "db/modules_DAL/userDAL.class.php";
	
	class LoginBL
	{
		public function LoginUser()
		{
			$username = ISSET($_POST["username"]) ? trim($_POST["username"]) : "";
			$password = ISSET($_POST["password"]) ? trim($_POST["password"]) : "";
			
			$username = htmlspecialchars($username);
			$password = htmlspecialchars($password);	

			$username = stripslashes($username);
			$password = stripslashes($password);
			
			if ($username != "" && $password != "")
			{
				
				$userDAL = new UserDAL();
				$user = $userDAL->GetUser($username, $password);
				
				if($user != null)
				{	
					
					$userDAL->UpdateLastLoginTime($user->GetID_KORISNIK());
					$this->SetUserObjectToSession($user);
					header("Location:home.php");
					exit;
				}
		
				return $user;
			}
		}
		
		public function RegisterUser()
		{
			$username = ISSET($_POST["username"]) ? trim($_POST["username"]) : "";
			$password = ISSET($_POST["password"]) ? trim($_POST["password"]) : "";
			$email = ISSET($_POST["email"]) ? trim($_POST["email"]) : "";
			
			$username = htmlspecialchars($username);
			$password = htmlspecialchars($password);
			$email = htmlspecialchars($email);
			
			$username = stripslashes($username);
			$password = stripslashes($password);
			$email = stripslashes($email);
			
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			$hashedPassword = password_hash($password,PASSWORD_DEFAULT);
			$last_login_time = date("Y-m-d H:i:s");
			
			if ($username != "" && $password != "" &&  $email != "" && $email !== false)
			{
				$UserDAL = new UserDAL();
				$user = $UserDAL->RegisterUser(null,$username,$hashedPassword,$email,$last_login_time ,USER_ROLE_KORISNIK,USER_STATUS_AKTIVAN);			
				if ($user != -1)
				{
					$this->LoginUser();
				}
			}	
		}
		
		private function SetUserObjectToSession($user)
		{
			$_SESSION["user"] = serialize($user);
			$_SESSION["timeout"] = time();
		}
		
		public function CheckUserSessionData($current_page = "")
		{
			if (ISSET($_SESSION["timeout"],$_SESSION["user"]))
			{
				$inactive = 600;//10 minuta				
				$sessionTimeToLeave = time() - $_SESSION["timeout"];
				
				if ($sessionTimeToLeave > $inactive)
				{
					$this->Logout();
				}
				$_SESSION["timeout"] = time();
				
				if ($current_page == "merchandize")
				{
					header("Location:home.php");
					exit;	
				}
				if ($current_page == "register" && !empty($_SESSION))
				{
					header("Location:home.php");
					exit;	
				}
			}
			else if ($current_page != "merchandize" && $current_page != "register")
			{
				$this->RedirectToMerchandizeLogin();
			}	
		}
		
		public function Logout()
		{
			$this->ClearSessions();
			$this->RedirectToMerchandizeLogin();
			
		}
		
		private function ClearSessions()
		{
			UNSET($_SESSION["user"],$_SESSION["timeout"]);
		}
		
		private function RedirectToMerchandizeLogin()
		{
			header("Location:merchandize.php");
			exit;
		}
	}
?>