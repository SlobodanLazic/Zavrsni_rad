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
				
				$feed = "https://www.youtube.com/feeds/videos.xml?playlist_id=PLDuBTz2Byh9MaprT9RPIzkGWsUJCYrMKe";
				$xml = simplexml_load_file($feed);
				$entries = $xml->entry;
				
				foreach($entries as $entry)
				{
					$published = $entry->published;
					$shortDate = date("d.m.Y", strtotime($published));
		
					$title = $entry->title;
					$id = $entry->id;
					$id = str_replace("yt:video:", "", $id);
					$author = $entry->author->name;
					$uri = $entry->author->uri;
					
					$content = sprintf("<article class='iframeContainer'>
											<h1><a class='btnStyle' href='%s'>%s</a></h1>
											<iframe src='%s%s' class='iframeSize' allowfullscreen>
											</iframe>
											<br>
											<small>Published: %s &nbsp; By: %s</small>
										</article>
										<hr>
										",
											$uri,
											$title,
											"http://www.youtube.com/embed/",
											$id,
											$shortDate,
											$author
										);
					echo $content;
				}
				
			?>
			<section class="bckToTop">
				<div>
					<button type="submit" name="bckToTop"><a href="#bckToOpt" class="btnStyle">Back to Top</a></button>
				</div>
			</section>
			
			</main> <!-- end of #main -->
			
			<footer id="footer">
				<p>Offical Prisoner WebSite &copy; 2018</p>
			</footer>
		</div> <!-- end of #wrapper -->
	</body>
</html>