<?php
	if(session_id() === "")
	{
		session_start();
	}
	require_once "modules_BL/user/loginBL.class.php";
	require_once "modules_BL/album/typeBL.class.php";
	require_once "modules_BL/album/albumBL.class.php";
	
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
	
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Insert Album</title>
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
			
			<main id="main">
				<div class="centeredFormWrapper">
					<h2>Add New Album</h2>
					<form action="#" method="POST" name="addAlbum" id="addAlbum" enctype="multipart/form-data">
						<div>
							<div>
								<label>Name</label>
							</div>
							<div>
								<input type="text" name="albmName" id="albmName">
							</div>
							<div id="albmNameError">
							</div>
						</div>
						<div>
							<div>
								<label>Year of release</label>
							</div>
							<div>
								<input type="text" name="rlsYear" id="rlsYear">
							</div>
							<div id="rlsYearError">
							</div>
						</div>
						<div>
							<div>
								<label>Cover</label>
							</div>
							<div>
								<input type="file" name="albmCover" id="albmCover">
							</div>
						</div>
						<div>
							<div>
								<label>Type</label>
							</div>
							<div>
								<select name="id_album_type">
									<?php
										if (isset($types) && $types != null)
										{
											foreach($types as $type)
											{
												printf("<option value='%s'>%s</option>",
												$type->GetId_album_type(),$type->GetName()
												);
											}
										}
									?>
								</select>
							</div>
						</div>
						<div>
							<div>
								<label>Price</label>
							</div>
							<div>
								<input type="text" name="price" id="price">
							</div>
						</div>
						<div>
							<div>
								<button type="submit" name="albmSbmt" class="btnStyle">Add Album</button> 
							</div>
						</div>
						<div>
							<div>
								<button type="reset" name="reset" class="btnStyle">Reset</button>
							</div>
						</div>
						<div>
							<div>
								<button type="submit" name="bckToOpt"><a href="home.php" class="btnStyle">Back to Options</a></button>
							</div>
						</div>
					</form>
					<div id="validationMsg">
						<?php
							if(ISSET($_POST["albmSbmt"], $_POST["albmName"], $_POST["rlsYear"], $_FILES["albmCover"], $_POST["id_album_type"],$_POST["price"]))
							{
								
								$albumBL = new AlbumBL();
								$validationMsg = $albumBL->InsertNewAlbum();
								
								echo "<p class='sucessful'>$validationMsg</p>";
							}
						?>
					</div>
				</div>
			</main>
			
			<footer id="footer">
				<p>Offical Prisoner WebSite &copy; 2018</p>
			</footer>
		</div>
	</body>
</html>