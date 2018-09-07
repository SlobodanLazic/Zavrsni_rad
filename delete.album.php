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
			
			<main class="delete">
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
				
				if(isset($_POST["delete"]) && $user->GetID_ROLA() == USER_ROLE_ADMINISTRATOR)
				{
					
				}
				
				if($albums != NULL)
				{	
					print "<table id='tableAlbums'>";
					echo  "<tr>
								<th>Name</th>
								<th>Year</th>
								<th>Type</th>
								<th>Price &euro;</th>
								<th>Identification number</th>
								<th>Delete album</th>
						   </tr>";
					foreach ($albums as $album)
					{	
						
						printf("
								<tr>
									<td>%s</td>
									<td>%s</td>
									<td>%s</td>
									<td>%s</td>
									<td>%s</td>
									<td>
										<form method='POST' action=''>
											<div class='hidden'>
												<input type='text' name='id_album' id='%s' value='%s'>
											</div>
											<div>
												<button class='btnStyle albumButton delete' name='delete'>Delete <i class='fas fa-trash-alt'></i></i></button>
											</div>
										</form>
									</td>
								</tr>
								", 
								$album->Getname(),$album->Getreleaseyear(),
								$album->Gettype_name(),$album->Getprice(),
								$album->Getid_album(),
								$album->Getid_album(),								
								$album->Getid_album()								
								);
					}
					print "<table>";
				}
								
			?>
				
				
			</main> <!-- end of #main -->
			
			<footer id="footer">
				<p>Offical Prisoner WebSite &copy; 2018</p>
			</footer>
		</div> <!-- end of #wrapper -->
	</body>
</html>