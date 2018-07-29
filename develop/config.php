<?php

	if (getenv("RDS_DB_SERVER") !== false) {
	   define('DB_SERVER', getenv("RDS_DB_HOSTNAME"));
	   define('DB_USERNAME', getenv("RDS_DB_USERNAME"));
	   define('DB_PASSWORD', getenv("RDS_DB_PASSWORD"));
	   define('DB_DATABASE', getenv("RDS_DB_NAME"));
	}
	else {
		define('DB_SERVER', 'localhost:3306');
	   define('DB_USERNAME', 'ddeckys');
	   define('DB_PASSWORD', 'password');
	   define('DB_DATABASE', 'dominicsql');
	}
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
