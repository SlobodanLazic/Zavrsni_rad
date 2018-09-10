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
		<title>Delete Album</title>
	<link href="https://fonts.googleapis.com/css?family=Metal+Mania" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/hide.js"></script>
	<script src="js/serverMsg.js"></script>
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
			
			<main class="delete">
				<section id="bckToOpt">
					<div>
						<button type="submit" name="bckToOpt"><a href="home.php" class="btnStyle">Back to Options</a></button>
					</div>
				</section>
				<table id='tableAlbums'>
					<tr>
						<th>Name</th>
						<th>Year</th>
						<th>Type</th>
						<th>Price &euro;</th>
						<th>Identification number</th>
						<th>Delete album</th>
					</tr>
					<?php
						$loginBL = new LoginBL();
						$loginBL->CheckUserSessionData();
						$user = unserialize($_SESSION["user"]);
						
						if($user->GetID_ROLA() != USER_ROLE_ADMINISTRATOR)
						{
							header("Location:home.php");
							exit;
						}
						
						$typeBL = new TypeBL();
						$types = $typeBL->GetTypes();
						
						$albumBL = new AlbumBL();
						$albums = $albumBL->GetAlbums();
						
						
						
						if($albums != NULL)
						{	  
							foreach ($albums as $album)
							{	
								if(isset($_POST["delete"]) && $user->GetID_ROLA() == USER_ROLE_ADMINISTRATOR)
								{	
									$id_album = $_POST["id_album"];
									if($id_album === $album->Getid_album())
									{	
										$albumBL = new AlbumBL();
										$validationMsg = $albumBL->DeleteAlbum($album);
									}
								}
								
								
								$explodedTypes = explode(",",$album->Gettype_name());
								printf("
									<tr>
										<td>%s</td>
										<td>%s</td>
										<td><span title='%s'>%s</span></td>
										<td>%s</td>
										<td>%s</td>
										<td>
											<form method='POST' action=''>
												<div>
													<input type='text' name='id_album' class='hidden id_album' id='%s' value='%s'>
													<button class='btnStyle albumButton delete' id='delete%s' name='delete'>Delete <i class='fas fa-trash-alt'></i></i></button>
												</div>
											</form>
										</td>
									</tr>
									", 
									$album->Getname(),$album->Getreleaseyear(),
									$explodedTypes[1],
									$explodedTypes[0],$album->Getprice(),
									$album->Getid_album(),
									$album->Getid_album(),								
									$album->Getid_album(),								
									$album->Getid_album()								
									);
							}
						}				
					
					print( 
					"</table>");
					echo "<div id='validationMsg'>";
					
					if (isset($validationMsg))
					{
					  echo "<p class='sucessful'>$validationMsg</p>";
					}
					else if(!isset($validationMsg))
					{
						echo "";
					}
					print "</div>";	
					
					?>
			</main>
			
			<footer id="footer">
				<p>Offical Prisoner WebSite &copy; 2018</p>
			</footer>
		</div>
	</body>
</html>