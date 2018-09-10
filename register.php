<?php
	if(session_id() === "")
	{
		session_start();
	}
	
	require_once("modules_BL/user/loginBL.class.php");
	require_once("modules_BL/user/registerBL.class.php");
	
	if (ISSET($_POST["register"],$_POST["username"],$_POST["password"],$_POST["email"]))
	{
		$registerBL = new RegisterBL();
		$register = $registerBL->RegisterUser();
		$loginBL = new LoginBL();
		$loginBL->CheckUserSessionData("register");
	}
	
		
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Register</title>
	<link href="https://fonts.googleapis.com/css?family=Metal+Mania" rel="stylesheet">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/validation.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<header id="header">
				<a href="index.html">
					<img src="images/prisoner_logo.jpg" alt="prisoner_logo.jpg">
				</a>	
			</header> 
			<nav id="nav">
				<ul>
					<li><a href="index.html">Prison</a></li>
					<li><a href="biography.html">Biography</a></li>
					<li><a href="discography.html">Discography</a></li>
					<li><a href="merchandize.php">Merchandize</a></li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
			</nav>
			
			<main id="main" class="register">
				<div id="formWrapperRegister">
					<h2>Register</h2>
					<form action="#" method="POST" name="register" id="registerForm">
						<div>
							<div>
								<label>Username</label>
							</div>
							<div>
								<input type="text" name="username" id="username">
							</div>
							<div id="usernameError">
							</div>
						</div>
						<div>
							<div>
								<label>Password</label>
							</div>
							<div>
								<input type="password" name="password" id="password">
							</div>
							<div id="passwordError">
							</div>
						</div>
						<div>
							<div>
								<label>Email</label>
							</div>
							<div>
								<input type="email" name="email" id="email">
							</div>
							<div id="emailError">
							</div>
						</div>
						<div>
							<div>
								<button type="submit" name="register" class="btnStyle">Register</button>
							</div>
						</div>
						<div id="backtoLgnWrapper">
							<div>
								<button type="submit"><a href="merchandize.php" class="btnStyle">Back to Login Page</a></button>
							</div>
						</div>
					</form>
					<div id="validationMsg">
					
					</div>
				</div>
				
			</main>
			
			<footer id="footer">
				<p>Offical Prisoner WebSite &copy; 2018</p>
			</footer>
		</div>
	</body>
</html>