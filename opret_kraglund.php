<?php session_start(); ?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Opret bruger</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php
//Når der er trykket på submit henter den informationer, ellers fejl.
if (filter_input(INPUT_POST, 'submit')){
	
	$un = filter_input(INPUT_POST, 'un')
		or die('Missing/illegal un parameter');
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Missing/illegal pw parameter');
	
	//krypterer koden
	$pw = password_hash($pw, PASSWORD_DEFAULT);
	
	
	require_once('db_con.php');
	//Variablerne sættes ind i strings
	$sql = 'INSERT INTO bruger (un, pw_hash) VALUES (?, ?)';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('ss', $un, $pw);
	$stmt->execute();
	
	if ($stmt->affected_rows > 0){
		echo 'user '.$un.' added.';
	}
	else {
		echo 'Could not add the user...';
	}
}
?>

<!--formen, når man bruger post kan man ikke se det oppe i url-baren-->
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

	<h1>Opret log ind</h1>
	<div>
		<h3>Opret bruger</h3>
    	<input name="un" type="text"     placeholder="Brugernavn" required /><br>
    	<input name="pw" type="password" placeholder="Kodeord"   required /><br><br>
    	<input name="submit" type="submit" value="Opret bruger" />
	</div>
</form>

	<a href="login_kraglund.php">Log ind</a>
</body>
</html>




