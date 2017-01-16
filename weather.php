<?php

	// GET THE USER'S CITY NAME
	$city = htmlspecialchars($_GET["city"]);

	// SET API KEY AND SEND REQUEST TO OPENWEATHERMAP
	$weatherKey = "API-KEY-GOES-HERE";
	$weatherURL = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&units=imperial&APPID=" . $weatherKey;

	// PARSE THE RESPONSE AND ECHO OUT THE RESULT FOR USE ON THE INDEX PAGE
	$weatherObj = file_get_contents( $weatherURL );
	$weatherReport = json_encode( $weatherObj );
	header('Content-Type: application/json');
	echo $weatherObj;

?>