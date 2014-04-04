<?php
	//login procedure
	$name = $_POST["username"];
	$pass = sha1($_POST["password"]);

	require_once("database.class.php"); 
	$connection = new Database("sbrettsc_db");

	$query = "SELECT * FROM users WHERE name = '" . $name . "' LIMIT 1";
	$arr = $connection->get_array_from_query($query);
	$results = array_shift($arr);

	if($results["password"] == sha1($pass . $results["salt"]))
	{
		if($results["admin"]){
			$_SESSION['shopping_cart']->set_admin(true);
		}
	}
	header("Location: ../../index.php");