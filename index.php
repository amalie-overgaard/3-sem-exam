<?php
require_once("db_con.php");
?>
<!doctype html>
<html>
	
<head>
<meta charset="utf-8">
<title>Kraglund video</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--gør at den virker på telefon -->
	<link href="stylesheet.css" rel="stylesheet">
	<link href="laptop.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
	<!--Jquery som bruges til at få burger og alt andet jquery på siden til at virke -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Source+Sans+Pro" rel="stylesheet"> 
	
</head>
<body>
    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '854321278062624',
      xfbml      : true,
      version    : 'v2.11'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
	<nav class="desktop">
	<div class="menu">
		<a href="#">Jeg tilbyder</a>
		<a href="#">Profil</a>
		<a href="#">Nyheder</a>
		<a href="#">Heste</a>
		<img class="logo" src="logo.jpg" alt="Kraglund-Logo">
		<a href="index.php" class="selected">Video</a>
		<a href="#">Sponsorer</a>
		<a href="#">Referencer</a>
		<a href="#">Kontakt</a>
	</div>
	</nav>
	
	<nav class="mobile">
		<button></button>
	<div>
		<!-- Mobil format -->
		<img class="mobile-logo" src="logo.jpg" alt="Kraglund-Logo">
		<a href="#">Jeg tilbyder</a>
		<a href="#">Profil</a>
		<a href="#">Nyheder</a>
		<a href="#">Heste</a>
		<a href="index.html" class="selected">Video</a>
		<a href="#">Sponsorer</a>
		<a href="#">Referencer</a>
		<a href="#">Kontakt</a>
	</div>
		</nav>
	<!-- Navigation slut-->
	
	<div class="container">
		<div class="content">
			<img class="swing" src="bo1.png" alt="Kraglund-SwingKing">
			<div class="content-text">
				<h1 class="overskrift-1">Træningsvideoer</h1>
				<br>
				<h3 class="overskrift-2">Velkommen til min nye platform for læring</h3>
				<p>I mit nye koncept vil jeg tilstræbe at lægge nye træningsvideoer ud hver 14. dag. Jeg håber at i er klar på at lære nye tricks, der forhåbentlig kan rykke jer lidt tættere på jeres mål!</p>
				<br>
			</div>
			<div class="content-text">
				<div class="videocontainer">
				<?php
					$hentOpslag = mysqli_query($link, "SELECT * FROM opslag ORDER BY id DESC");
				while($opslag = mysqli_fetch_array($hentOpslag)){
					?>
					<h1 class="overskrift"><b><?=$opslag["overskrift"]?></b></h1>
					<p class="beskrivelse"><?=$opslag["tekst"]?></p>
					<video src="<?=$opslag["link"]?>" controls></video>
				<?php
				}
				?>
				</div>
				<div
  class="fb-like"
  data-share="true"
  data-width="900"
  data-show-faces="true">
                </div>
                <iframe src="https://www.facebook.com/plugins/comment_embed.php?href=https%3A%2F%2Fwww.facebook.com%2Fpermalink.php%3Fstory_fbid%3D310365806117773%26id%3D310358882785132%26comment_id%3D311851749302512&include_parent=false" width="560" height="151" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
			</div>
		</div>
	</div>
	<footer class="foot">
		&copy; Disclaimer- Denne side er en del af et eksamensprojekt.
	</footer>	
	<script src="burger.js"></script>
</body>
</html>
