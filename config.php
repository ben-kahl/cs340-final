<!-- Group 30 - Ben Kahl -->
<?php
	mysqli_report(MYSQLI_REPORT_ERROR );

	/* Change for your username and password for phpMyAdmin*/
	define('DB_SERVER', 'classmysql.engr.oregonstate.edu');
	define('DB_USERNAME', 'cs340_kahlb');
	define('DB_PASSWORD', '6520');
	define('DB_NAME', 'cs340_kahlb');
	 
	/* Attempt to connect to MySQL database */
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	 
	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
?>
