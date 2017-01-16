<?php 

// SET VARIABLES FOR AUTHENTICATION
$user = '';
$pass = '';
$name = array('damion' => 'myPass');

// TEST IF USER SUBMITTED DATA
if ( isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	// GET USER INFO
	$user = htmlspecialchars( $_POST['user'] );
	$pass = htmlspecialchars( $_POST['pass'] );

	// IF USERNAME EXISTS AND PASSWORD MATCHES THEN START SESSION AND GO TO COFFEE.PHP
	if ( $pass === $name[$user] ) {
		session_start();
		$_SESSION['login'] = "1";
		$_SESSION['user'] = $user;
		header ("Location: coffee.php");
	}
	// OTHERWISE, START SESSION AND SET FLAG FOR FAILED LOGIN ATTEMPT
	else {
		session_start();
		$_SESSION['login'] = '';
	}

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<!-- MAKE THE BROWSER WINDOW PRETTY ON MOBILE DEVICES -->
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#463e39">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#463e39">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

	<title>Coffee Count | Login</title>

	<link rel="stylesheet" href="../assets/bootstrap-3.3.7-dist/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">

</head>
<body class="container">

<div id="main" class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<h1>Coffee Count</h1>

		<p id="showWeather">
			<!-- DISPLAY WELCOME MESSAGE BASED ON LOCAL WEATHER (IF USERS ENTERS LOCATION) -->
			It is <span id="temperature"></span><sup>&deg;</sup>F in
			<span id="city" tabindex="0">Phoenix</span>
			<input id="cityInput" maxlength="100" placeholder="What city are you in?" title="type city name then press enter">
			, a good day for <span id="tDrink"></span>.
		</p>

		<?php
			// IF FAILED LOGIN FLAG IS SET THEN DISPLAY FAILURE MESSAGE
			if ( isset($_SESSION['login']) && $_SESSION['login'] === '') {
				echo '<p id="fail">Login attempt failed.</p>'; echo $user . ' ' . $pass;
			}
		?>

		<!-- LOGIN FORM THAT USES THE PHP FUNCTIONS ABOVE -->
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id="formCup">
			<div class="form-group">
				<input type="text" class="form-control" id="user" name="user" placeholder="username" aria-label="username">
			</div>
			<br>
			<div class="form-group">
				<input type="password" class="form-control" id="pass" name="pass" placeholder="password" aria-label="password">
			</div>
			<br>
			<button type="submit" id="submit" name="submit" class="btn btn-default">Submit</button>
		</form>
	</div>
</div>




<script src="../assets/jquery-3.1.0.js"></script>
<script src="../assets/bootstrap-3.3.7-dist/js/bootstrap.js"></script>
<script src="script.js"></script>
	
</body>
</html>