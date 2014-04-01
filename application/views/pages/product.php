<div class="product">

	<div id="media">
	<?php 
		echo "<div id='mainmedia'><img src='img/" . $image . "' id='mainimg'></div><br/>"; 
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
        <a href="#" class="add_item_to_shoppingcart"><?php 
                if(isset($added_to_cart) && $added_to_cart){echo 'Added to cart';} 
                elseif ($stock==0) {echo 'Sorry, Out of stock';} 
                else {echo 'Add to shoppingcart';} 
            ?></a>
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
					echo "<li>" . $row['spec'] . ": " . $row['spec_value'] . "</li>";
				}
			?>
		</ul>

	</div>
</div>
