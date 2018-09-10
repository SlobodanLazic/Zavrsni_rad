<?php
	if(session_id() === "")
	{
		session_start();
	}
	require_once "modules_BL/user/loginBL.class.php";
	require_once "modules_BL/album/albumBL.class.php";
	
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>View All Albums</title>
	<link href="https://fonts.googleapis.com/css?family=Metal+Mania" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/hide.js"></script>
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
			
			<main id="main" class="view" ng->
				<section id="bckToOpt">
					<div>
						<button type="submit" name="bckToOpt"><a href="home.php" class="btnStyle">Back to Options</a></button>
					</div>
				</section>
			
			<?php
				$loginBL = new LoginBL();
				$loginBL->CheckUserSessionData();
				$user = unserialize($_SESSION["user"]);
				
				$typeBL = new TypeBL();
				$types = $typeBL->GetTypes();
				
				$albumBL = new AlbumBL();
				$albums = $albumBL->GetAlbums();
				
				$userBuybutton = "	
								<div>
									<button  class='btnStyle albumButton buy' name='buy'>Buy <i class='fas fa-shopping-cart'></i></button>
								</div>
								";
							
				if($albums != NULL)
				{
					foreach ($albums as $album)
					{	
						$id_Album = "<p>Identification number:" .  $album->Getid_album()  . "</p>";
						$imagePath = sprintf("images/albums/%d/%s", $album->Getid_album(),$album->Getcover());
						$explodedTypes = explode(",",$album->Gettype_name());
						
						printf("
								<div class='buyAlbum'>
									<div>
										<img src='%s' alt='%s'>
										<p>Name: %s</p>
										<p>Year: %s</p>
										<p title='%s'>Type: %s</p>
										<p>Price: %s &euro;</p>
											%s
										<form method='POST' action=''>
											<div >
												<input type='text' class='hidden' name='id_album' id='%s' value='%s'>
											</div>
											%s
										</form>
									</div>
									<div class='clr'>
									</div>
								</div>
								", 
								$imagePath, 
								$album->Getcover(),
								$album->Getname(),
								$album->Getreleaseyear(),
								$explodedTypes[1],
								$explodedTypes[0],
								$album->Getprice(),
								$user->GetID_ROLA() == USER_ROLE_ADMINISTRATOR ? $id_Album : "", 
								$album->Getid_album(), 
								$album->Getid_album(), 
								$user->GetID_ROLA() == USER_ROLE_KORISNIK ? $userBuybutton : ""
								);
						
							if(isset($_POST["buy"]) && $user->GetID_ROLA() == USER_ROLE_KORISNIK)
							{	
								$id_album = $_POST["id_album"];
								$username = $user->GetUSERNAME();
								$usernameEmail = $user->GetEMAIL();
								
								if($id_album === $album->Getid_album())
								{	
								
									$albumBL = new AlbumBL();
									$albumBL->BuyAlbum($album,$user);
								}
							}
					}
				}
								
			?>
			</main>
			
			<footer id="footer">
				<p>Offical Prisoner WebSite &copy; 2018</p>
			</footer>
		</div>
	</body>
</html>