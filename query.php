<?php 
	require('sslLabsApi.php'); //Calls the SSL labs API file 
	$repeat = TRUE; //Defaults to the loop repeating
	$api = new sslLabsApi(); //Creates a new API object 
	$api->setReturnJsonObjects(TRUE); //Forces the API to return an object for easier processing
	$sdomain = trim($_POST["domain"]); //Grabs the domain from the post request
	$statusObject = $api->fetchHostInformation($sdomain); //Retrieves the initial host object to check status
	do {
		$status = $statusObject->status; //Checks if the request is finished or is still processing qualy side
		if ($status != "READY") { //If process is not ready sleeps then tries again
			sleep(30); //Arbitrary value, seems about right
			$statusObject = $api->fetchHostInformation($sdomain); //Resends the request to the API to check if ready yet
		} else {
			$repeat = FALSE; //Sets repeat to false so the loop can exit
               		$endpointObject = $statusObject->endpoints; //Retrieves the endpoints from the host object to extract grade
                	$gradeObject = $endpointObject[0]; //The endpoint object is actually an array of every server on the website, this defaults to the first one
        	        $grade = $gradeObject->gradeTrustIgnored; //Extracts the grade ignoring trust from the endpoint object
			echo "$grade"; //Sends the grade back to the client
		}
	} while ($repeat); //If test isnt complete loops back
?>
