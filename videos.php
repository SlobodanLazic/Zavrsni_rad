<?php
	if(session_id() === "")
	{
		session_start();
	}
	require_once "modules_BL/user/loginBL.class.php";
	require_once "modules_BL/album/albumBL.class.php";
	include_once "modules_BL/playlist/playlistBL.class.php";
	
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>View Our Videos</title>
	<link href="https://fonts.googleapis.com/css?family=Metal+Mania" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/loadingVideos.js"></script>
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
			
			<main id="main" class="view">
				<section id="bckToOpt">
					<div>
						<button type="submit" name="bckToOpt"><a href="home.php" class="btnStyle">Back to Options</a></button>
					</div>
				</section>
			<?php
				$loginBL = new LoginBL();
				$loginBL->CheckUserSessionData();
				$user = unserialize($_SESSION["user"]);
				if($user->GetID_ROLA() != USER_ROLE_KORISNIK)
				{
					header("Location:home.php");
					exit;
				}
				
				$playlist = new PlaylistBL();
				$contents = $playlist->WatchVideos();					
				
				foreach ($contents as $content)
				{	
					
					echo $content;
									
				}
				
			?>
			<section class="bckToTop">
				<div>
					<button type="submit" name="bckToTop"><a href="#bckToOpt" class="btnStyle">Back to Top</a></button>
				</div>
			</section>
			</main> 
			
			<footer id="footer">
				<p>Offical Prisoner WebSite &copy; 2018</p>
			</footer>
		</div>
	</body>
</html>