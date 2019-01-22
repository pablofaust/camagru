<?php

 	ini_set('display_errors', 'on'); 

 	require_once '../config/database.php'
  	require_once '../config/setup.php'

	require_once '../app/Autoloader.php'; 
	Autoloader::register(); 

	if (isset($_GET['p'])) {
		$p = $_GET['p'];
	}

	else {
		$p = 'home';
	}

	ob_start();

	if ($p === 'home') {
		require '../pages/home.php';
	}

	else if ($p === 'login') {
		require '../pages/login.php';
	}

	$content = ob_get_clean();

	require '../pages/templates/default.php'
?>