<?php

	require_once __DIR__ . '/database.php';

	try {

		$database = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

		$database->exec("CREATE DATABASE `$DB_NAME`;
                CREATE USER '$DB_NEW_USER'@'localhost' IDENTIFIED BY '$DB_NEW_PASS';
                GRANT ALL ON `$camagru`.* TO '$DB_NEW_USER'@'localhost';
                FLUSH PRIVILEGES;")
		 or die(print_r($database->errorInfo(), true));
	} 
	
	catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }

?>