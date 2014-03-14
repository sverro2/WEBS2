<?php
	$category = $_POST['parameter'];
	$product_query = "SELECT * FROM product WHERE category_id = " . $category;
	$category_query = "SELECT * FROM category WHERE id = " . $category;
    require_once('../class/database.class.php');
    $connection = new Database("sbrettsc_db");
    
    $product_array = $connection->get_array_from_query($product_query);
    $category_array = $connection->get_array_from_query($category_query);
    $category_data = array_shift($category_array);
    $category_image = $category_data['thumbnail'];
?>

<div id="catleft">
	<div class="cat_container">
		<?php

		    echo PHP_EOL . "<div class='categoryimage'>";
		    echo PHP_EOL . "<h1> " . $category_data['label'] . "</h1>";
		    echo PHP_EOL . "<img src='" . $category_data['thumbnail'] . "'>";
		    echo PHP_EOL . "</div>";

		?>
	</div>
</div>

<div id="catmain">
	<?php
		foreach($product_array as $row)
		{
			echo PHP_EOL . "<div class='productrow'>";
			echo PHP_EOL . "<a href='#' class='productlink' data-product='" . $row['id'] . "'><img src='img/" . $row['defaultimage'] . "' class='thumb'></a>";
			echo "<div class='description'><h1>" . $row['title'] . "</h1>" . $row['fullname'] . "</div>";
			echo PHP_EOL . "</div>";
		}
	?>
</div>