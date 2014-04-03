<?php
	require_once("database.class.php"); 
	$connection = new Database("sbrettsc_db");

	$title = $_POST['title'];
	$img = $_POST['image'];
	if($img == ""){
		$img = "defaultcategory.png";
	}
	$url = $_POST['url'];
	$id = $_POST['id'];
	$query = "";
	if($id != 0){
		$query = "UPDATE category SET label='" .$title . "', url='" . $url . "', thumbnail='img/" . $img . "' WHERE id = " . $id;
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