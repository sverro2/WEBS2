<?php
	require_once("database.class.php"); 
	$connection = new Database("sbrettsc_db");

	$title = $_POST['title'];
	$img = $_POST['image'];
	if($img == ""){
		$img = "defaultcategory.png";
	}
	$url = $_POST['url'];

	$exists_query = "SELECT * FROM category WHERE label = '" . $title . "' LIMIT 1";
	$exists_results = $connection->get_array_from_query($exists_query);
	$query = "";
	$id = 0;
	if(isset($exists_results) && count($exists_results) > 0){
		$category = array_shift($exists_results);
		$query = "UPDATE category(label, thumbnail) SET ('" .$title . "', 'img/" . $img . "') WHERE id = " . $category['id'];
		$id = $category['id'];
	}else{
		$query = "INSERT INTO category(label, url, thumbnail) VALUES ('" .$title . "', '" . $url . "', 'img/" . $img . "')";
	}
	$connection->do_sql($query);
	if($id == 0)
	{
		$cat_data = $connection->get_array_from_query($exists_query);
		$category = array_shift($cat_data);
		$id = $category['id'];
	}
	echo $id;