<?PHP

session_start();

// REDIRECT TO INDEX PAGE IF USER IS NOT LOGGED IN
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: index.php");
	echo $name[$user][0];
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<!-- CODE FOR BASE64 FAVICON -->
	<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAACJqckAAAAAAP///wBZeJYAJ01zAJHd6wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAERERERERERERERERERERERERERERERERERREREERERERQiIiJBERERQlJSUlQRERFFJSUlJBEREUJSUlJURBERQiIiIiQUERFCREREJEQREUQAAABEERERFEREREERERERERERERERERExExExERERExExExERERERMRMRMRERH//wAA//8AAP//AADgfwAAwD8AAIAfAACAHwAAgAcAAIAXAACABwAAgB8AAMA/AAD//wAA7b8AANt/AADtvwAA" rel="icon" type="image/x-icon" />

	<!-- MAKE THE BROWSER WINDOW PRETTY ON MOBILE DEVICES -->
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#463e39">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#463e39">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

	<title>Coffee Count</title>

	<link rel="stylesheet" href="../assets/bootstrap-3.3.7-dist/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">

	<?php 
		// PASS THE USERNAME VARIABLE FROM PHP TO JS
		echo '<script>var username = "' . $_SESSION['user'] . '";</script>'; 
	?>

</head>
<body class="container">

<div id="main" class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<h1>Coffee Count</h1>
		<p>Keep track of the coffee you drink.</p>
		<p>
			<span id="lastUser">&nbsp;</span> last one was 
			<span id="lastCup">&nbsp;</span>, <span id="lastCupDate">&nbsp;</span> <span id="sincePlural">days ago.</span>
		</p>

		<div id="formCup" class="form-group">
			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Drink Menu
					<span class="caret"></span>
				</button>
				<ul id="saucer" class="dropdown-menu" aria-labelledby="dropdownMenu1">
					<li><a href="#">Drip</a></li>
					<li><a href="#">Espresso</a></li>
					<li><a href="#">Latte</a></li>
					<li><a href="#">Mocha/Flavored Latte</a></li>
					<li><a href="#">Cappuccino</a></li>
					<li><a href="#">7:01 AM / Depth Charge</a></li>
					<li><a href="#">Americano</a></li>
					<li><a href="#">Macchiato</a></li>
					<li><a href="#">French Press</a></li>
					<li><a href="#">Turkish Coffee</a></li>
					<li><a href="#">Sunrise</a></li>
					<li role="seperator" class="dropdown-header">Iced Drinks:</li>
					<li><a href="#">Iced Toddy / Cold Brew</a></li>
					<li><a href="#">Iced Latte</a></li>
					<li><a href="#">Iced Cappuccino</a></li>
					<li><a href="#">Iced Americano</a></li>
					<li><a href="#">Blended / Frappe</a></li>
				</ul>
			</div>
			<button id="submitCup" class="btn btn-default" aria-live="polite">Submit</button>
		</div>
	</div>
</div>




<script src="../assets/jquery-3.1.0.js"></script>
<script src="../assets/bootstrap-3.3.7-dist/js/bootstrap.js"></script>
<script src="script.js"></script>
	
</body>
</html>