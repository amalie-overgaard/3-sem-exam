<?php
ob_start();
require_once('db_con.php');
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<link href="stylesheet.css" rel="stylesheet">
</head>

<body>

<?php
//Henter indsatte informationer, og hvis de ikke er gyldige melder den det.
if (filter_input(INPUT_POST, 'submit')){
	$un = filter_input(INPUT_POST, 'un')
		or die('Missing/illegal un parameter');
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Missing/illegal pw parameter');
	
	// $pwhash = hent fra db;
	$sql = 'SELECT id, un, pw_hash FROM bruger WHERE un=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($id, $uid, $pwhash);
	
	

	while($stmt->fetch()) {  }
    //Tjekker om det kodeord du har skrevet nu, matcher kodeordet fra databasen
	if (password_verify($pw, $pwhash)){
		echo '';
		//hvis de matcher begynder den at logge ind, 
		$_SESSION['un'] = $uid;
		$_SESSION['username'] = $un;
		$_SESSION['id'] = $id;
		
		header("Location: admin.php");
		exit();
	}
	else {
		echo 'Forkert kombination af brugernavn/kodeord';
	}
}
?>

<!--formen, når man bruger post kan man ikke se det oppe i url-baren-->
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
<div class="login-box">
	<h1>Velkommen Katrine</h1>
	<p>Her kan du logge ind og uploade dine videoer</p>
	
	<div class="login">
    	<h3>Log ind</h3>
    	<input name="un" type="text"     placeholder="Brugernavn" required /><br>
    	<input name="pw" type="password" placeholder="Kodeord"   required /><br><br>
    	<input name="submit" type="submit" value="Log ind" class="login-buttom"/>
	</div>
</div>
</form>


</body>
</html>