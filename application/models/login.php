<?php
        ini_set('display_errors',1);
	require_once("database.class.php"); 
        require_once("session.class.php"); 

        session_start();
        $_SESSION['shopping_cart']->is_admin();
        if(!isset($_SESSION['shopping_cart'])){
            $_SESSION['shopping_cart'] = new session();
        }
	if(isset($_POST)){
		echo "yup";
	}else{
		echo "nope";
	}
	$name = $_POST["username"];
	$pass = sha1($_POST["password"]);

        
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