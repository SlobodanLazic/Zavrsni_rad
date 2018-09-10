<?php
	if(session_id() === "")
	{
		session_start();
	}
	
	require_once("modules_BL/user/loginBL.class.php");
	
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Albums</title>
	<link href="https://fonts.googleapis.com/css?family=Metal+Mania" rel="stylesheet">
	<link href="css/style.css" type="text/css" rel="stylesheet">
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
			
			<main id="main" class="centeredFormWrapper">
				<?php
					$loginBL = new LoginBL();
					$loginBL->CheckUserSessionData();
					
					$user = unserialize($_SESSION["user"]);
					
					$videos = sprintf("
					<div>
						<button type='submit'><a href='%s' class='btnStyle'>View Our Videos</a></button>
					</div>", "videos.php"
					);
					$listAlbums = sprintf("
					<div>
						<button type='submit'><a href='%s' class='btnStyle'>View All Albums</a></button>
					</div>", "albums.php"
					);
					$insertAlbum = sprintf("
					<div>
						<button type='submit'><a href='%s' class='btnStyle'>Add New Album</a></button>
					</div>", "insert.album.php"
					);
					
					$deleteAlbum = sprintf("
					<div>
						<button type='submit'><a href='%s' class='btnStyle'>Delete Album</a></button>
					</div>", "delete.album.php"
					);
					printf(
					"	
						%s
						%s
						%s
						%s
					",
						$user->GetID_ROLA() == USER_ROLE_KORISNIK ? $videos : "",
						$listAlbums,
						$user->GetID_ROLA() == USER_ROLE_ADMINISTRATOR ? $insertAlbum : "",
						$user->GetID_ROLA() == USER_ROLE_ADMINISTRATOR ? $deleteAlbum : ""
					);
				?>
				<div>
					<button type="submit"><a href="logout.php" class="btnStyle">Log Out</a></button>
				</div>
			</main>
			
			<footer id="footer">
				<p>Offical Prisoner WebSite &copy; 2018</p>
			</footer>
		</div>
	</body>
</html>