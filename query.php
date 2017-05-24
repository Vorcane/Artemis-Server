<?php
	require('sslLabsApi.php'); //Calls the SSL labs API file
	$api = new sslLabsApi(); //Creates a new API object
	$sdomain = trim($_POST["domain"]); //Grabs the domain from the post request
	var_dump($api->fetchHostInformation($sdomain)); //Dumps the variables from the object to console
	$myvar = ob_get_clean(); //Grabs the console output and saves it. This is pretty dirty but it will do until I can think of something better
	$gradeindex = strpos($myvar, "gradeTrustIgnored"); //Finds the index of the field we are looking for
	$gradeindex = $gradeindex + 21; //Adds the set amount of spaces to the index to extract only the grade
	$grade = substr($myvar, $gradeindex, 1); //Substrings from the console output to just grab the grade
	echo "$grade"; //Returns the grade
?>
