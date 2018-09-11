<?php
	include_once ("modules_BL/user/loginBL.class.php");
	
	class RegisterBL extends LoginBL
	{
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
	}
?>