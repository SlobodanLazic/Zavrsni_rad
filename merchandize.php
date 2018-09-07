<?php
	
	if (session_id() === "")
	{
		session_start();
	}
	require_once("modules_BL/user/loginBL.class.php");
	
	$loginBL = new LoginBL();
	$loginBL->CheckUserSessionData("merchandize");
	
	if (ISSET($_POST["username"], $_POST["password"]))
	{
		$returnedUser = $loginBL->LoginUser();
		
		if($returnedUser == null)
		{
			echo "<div id='validationMsg'>Username or password is empty or not valid</div>";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Merchandize</title>
	<link href="https://fonts.googleapis.com/css?family=Metal+Mania" rel="stylesheet">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/validation.js"></script>
	<script src="js/serverMsg.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<header id="header">
				<a href="index.html">
					<img src="images/prisoner_logo.jpg" alt="prisoner_logo.jpg">
				</a>	
			</header> <!-- end of #header -->
			
			<nav id="nav">
				<ul>
					<li><a href="index.html">Prison</a></li>
					<li><a href="biography.html">Biography</a></li>
					<li><a href="discography.html">Discography</a></li>
					<li><a href="merchandize.php">Merchandize</a></li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
			</nav> <!-- end of #navigation -->
			
			<main id="main" class="merchandize">
				<div class="videoWrapper">
						<video autoplay muted loop>
							<source src="video/Prisoner_Beast_In_The_Mirror.mp4">
						</video>
				</div>
				<div id="formWrapper">
					<h2>Log In</h2>
					<form action="" method="POST" name="login" id="loginForm">
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
								<button type="submit" class="btnStyle">Log In</button>
							</div>
						</div>
						<div id="registerWrapper">
							<div>
								<label>Don't have an account?</label>
							</div>
							<div>
								<button type="submit"><a href="register.php" class="btnStyle">Register</a></button>
							</div>
						</div>
					</form>
					<div id="destination">
					</div>
				</div> <!-- end of #formWrapper -->
				
			</main> <!-- end of #main -->
			
			<footer id="footer">
				<p>Offical Prisoner WebSite &copy; 2018</p>
			</footer>
		</div> <!-- end of #wrapper -->
	</body>
</html>