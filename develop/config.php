<?php

	if (isset($_SERVER['RDS_DB_HOSTNAME'])) {
	   define('DB_SERVER', $_SERVER['RDS_DB_HOSTNAME'] . ':' . $_SERVER['RDS_PORT']);
	   define('DB_USERNAME', $_SERVER['RDS_DB_USERNAME']);
	   define('DB_PASSWORD', $_SERVER['RDS_DB_PASSWORD']);
	   define('DB_DATABASE', $_SERVER['RDS_DB_NAME']);
	}
	else {
		define('DB_SERVER', 'localhost:3306');
	   define('DB_USERNAME', 'ddeckys');
	   define('DB_PASSWORD', 'password');
	   define('DB_DATABASE', 'dominicsql');
	}
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
