<?php

	//Initialisation de la database
	$db = new Database('camagru');

	//Gestion des images
	$images = ($db->sql_select("SELECT * FROM images"));

	//Si les images ne sont pas stockées dans la BDD, on les ajoute
	if (count($images) === 0) {
		$db->sql_insert("INSERT INTO images (title) VALUES ('moutard1.jpg'), ('moutard2.jpg'), ('moutard3.jpg')");
	}

?>