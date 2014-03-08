<?php
	$product_id = $_POST['id'];
	$product_query = "SELECT * FROM product WHERE id = " . $product_id . " LIMIT 1";
    $spec_query = "SELECT spec, spec_value FROM product_specification AS ps JOIN specification AS s ON ps.spec_id = s.id WHERE product_id = " . $product_id;
    $img_query = "SELECT url FROM image WHERE product_id = " . $product_id;
    $yt_query = "SELECT url FROM youtube WHERE product_id = " . $product_id;
    require_once('../class/database.class.php');
    $connection = new Database("sbrettsc_db");
    
    $product_data_array = $connection->get_array_from_query($product_query);
    $product_specs_array = $connection->get_array_from_query($spec_query);
    $product_images_array = $connection->get_array_from_query($img_query);
    $product_videos_array = $connection->get_array_from_query($yt_query);
    $product_data = array_shift($product_data_array);

	$image = $product_data['defaultimage'];
	$title = $product_data['title'];
	$price = $product_data['price'];
	$fullname = $product_data['fullname'];
	$description = $product_data['description'];
	$stock = $product_data['stock'];
?>
<div class="product">

	<div id="media">
	<?php 
		echo "<div id='mainmedia'><img src='img/" . $image . "'></div><br/>"; 
		foreach($product_images_array as $row)
		{
			echo "<img src='img/" . $row['url'] . "' class='mediathumb mediaimg' data-url='img/" . $row['url'] . "'>";
		}
		foreach($product_videos_array as $row)
		{
			echo "<img src='http://img.youtube.com/vi/" . $row['url'] . "/2.jpg' class='mediathumb mediavid' data-url='" . $row['url'] . "'>";
		}
	?>
	</div>


	<div id="details">
		<h1><?php echo $title; ?></h1>
		<h2><?php echo $fullname; ?></h2>
		<h1 id="price">&euro;<?php echo $price; ?></h1>
		<p id="availability">
			<?php
				if($stock < 1)
				{
					echo "<span id='nostock'>out of stock</span>";
				}else if($stock < 20){
					echo "<span id='limitstock'>limited stock</span>";
				}else{
					echo "<span id='fullstock'>large stock</span>";
				}
			?>
		</p>

		<h1>Description</h1>
		<p id="description">
		<?php echo $description; ?>
		</p>

		<h1>Features</h1>
		<ul>
			<?php
				foreach($product_specs_array as $row)
				{
					echo "<li>" . $row['spec'] . ":" . $row['spec_value'] . "</li>";
				}
			?>
		</ul>

	</div>
</div>