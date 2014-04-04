<?php
	require_once("database.class.php"); 
	$connection = new Database("sbrettsc_db");

	$text = $_POST['text'];
	$text = str_replace( "\n", "<br />", $text ); 
	$query = "UPDATE texts SET text= '" . $text . "' WHERE name='about'";

	$connection->do_sql($query);