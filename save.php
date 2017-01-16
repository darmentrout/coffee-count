<?php

	// GET DATA FROM JSON FILE AND GET IT READY FOR USE IN PHP
	$str = file_get_contents('coffee-cups.json');
	$json = json_decode($str, true);

	// GET SUBMITTED DATA AND PREPARE IT
	$cleanCup = file_get_contents('php://input');
	$cleanCup = explode(",", $cleanCup);

	// ADD NEW ENTRY TO ARRAY AND CONVERT IT TO JSON
	array_push($json, $cleanCup);
	$json = json_encode($json);

	// OPEN THE JSON FILE, WRITE TO IT, AND CLOSE IT OR THROW ERROR
	$cupHolder = fopen("coffee-cups.json", "w") or die("Unable to open file!");
	$cupData = $json;
	fwrite($cupHolder, $cupData);
	fclose($cupHolder);

?>