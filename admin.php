<?php
require_once("db_con.php");
// tjekker hvis der er blevet trykket på knappen
if(isset($_GET["tilfoej"])){
	// Henter de forskellige værdier fra formen
	$overskrift = $_POST["overskrift"];
	$tekst = $_POST["tekst"];
	$mappenavn = "uploads/";
	// Laver et unikt id ud fra tiden i sekunder
	$tidspunkt = round(microtime(true) * 1000);
	// Bestemmer hvad filens sti skal være
	$video = $mappenavn . $tidspunkt . "-" . basename($_FILES["link"]["name"]);
	// Henter videoens fil type, f.eks. mp4, avi osv.
	$videotype = strtolower(pathinfo($video, PATHINFO_EXTENSION));
	$videofil = $_FILES["link"];
	
	// Tjekker hvis det er gyldig filtype
	if($videotype != "mp4" && $videotype != "avi" && $videotype != "mov"){
		echo '<script>javascript:alert("Filtypen er ikke understøttet");</script>';
	} else {
		//tjekker om upload processen er igang
		if(move_uploaded_file($videofil["tmp_name"], $video)){
			//indsætter i databasen
			mysqli_query($link, "INSERT INTO opslag (overskrift, tekst, link) VALUES ('{$overskrift}', '{$tekst}', '{$video}')");
			echo '<script>javascript:alert("Filen blev uploadet");</script>';
		} else {
			echo '<script>javascript:alert("Filen kunne ikke uploades");</script>';
		}
	}
	
}
/*Tjekker linket- om slet hr en værdi*/
if(isset($_GET["slet"])){
    mysqli_query($link, "DELETE FROM opslag WHERE id='{$_GET["slet"]}'");
    echo '<script>javascript:alert("Opslaget er nu slettet.");</script>';
}
//Tjekker om rediger har en værdi
if(isset($_POST["rediger"])){
    $overskrift = $_POST["overskrift"];
    $tekst = $_POST["tekst"];
    $id = $_POST["id"];
    //Den opdater databasen og kommer med en melding
    mysqli_query($link, "UPDATE opslag SET overskrift='{$overskrift}', tekst='{$tekst}' WHERE id='{$id}'");
    echo '<script>javascript:alert("Opslaget er nu redigeret.");</script>';
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Panel</title>
	<link href="stylesheet.css" rel="stylesheet">
</head>

<body>
	<?php
	if(empty($_SESSION['un'])) {
		echo 'Du skal være logget ind for at se indholdet';
	}
	else {
	    //Tjekker om rediger har en værdi i linket
	    if(isset($_GET["rediger"])){
	  $hentdata = mysqli_query($link, "SELECT * FROM opslag WHERE id='{$_GET["rediger"]}'");
	  //Henter de informationer baseret på id'et
    $opslag = mysqli_fetch_assoc($hentdata);
	   ?>
	<form class="admin" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
	    <input type="hidden" name="id" value="<?=$_GET["rediger"]?>">
		<input type="text" name="overskrift" placeholder="Overskrift" value="<?=$opslag["overskrift"]?>"><br>
		<textarea name="tekst" placeholder"Beskrivelse"><?=$opslag["tekst"]?></textarea><br>
		<input type="submit" name="rediger" value="Rediger">
	</form>
	   <?php
	   //Hvis rediger ikke har en værdi, skal den vise "opret formen" i stedet for.
	    } else {
	        ?>
	<form class="admin" action="?tilfoej" method="post" enctype="multipart/form-data">
		<input type="text" name="overskrift" placeholder="Overskrift"><br>
		<textarea name="tekst" placeholder"Beskrivelse"></textarea><br>
		<input type="file" name="link"><br>
		<input type="submit" name="opret" value="Opret">
	</form>
	        <?php
	    }
		?>
	<div class="videoer">
	    <?php
	    //Henter listen over indhold i databasen
	    $hentOpslag = mysqli_query($link, "SELECT * FROM opslag ORDER BY id DESC");
	    while($opslag = mysqli_fetch_array($hentOpslag)){
	    ?>
	    <div class="video">
	        <?=$opslag["overskrift"]?>
	        <div class="videoknapper"><a href="?rediger=<?=$opslag["id"]?>">Rediger</a> - <a href="?slet=<?=$opslag["id"]?>">Slet</a></div>
	    </div>
	    <?php
	    }
	    ?>
	</div>
	<?php
	}
?>
	<a class="logud" href="logud_kraglund.php">Log ud</a>
</body>
</html>