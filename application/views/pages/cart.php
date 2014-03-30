<div id="catleft">
	<div class="cat_container">
		<a href="index.php" id="backbutton">

		    
            
            <div class='categoryimage' style='background-image: url(img/misccategory.png)'>
            <h1>Cart</h1>
            </div>
	</div>
</div>
<div id="catmain">
	<?php
		if(is_array($product_array) && count($product_array) > 0){
			foreach($product_array as $row)
			{
				echo PHP_EOL . "<a href='?route=category/product/" . $row['id'] . "' class='productlink'>";
				echo PHP_EOL . "<div class='productrow'>";
				echo PHP_EOL . "<img src='img/" . $row['defaultimage'] . "' class='thumb'>";
				echo "<div class='description'><h1>" . $row['title'] . "</h1>" . $row['fullname'] . "</div>";
				echo PHP_EOL . "</div></a>";
			}
		}
	?>
</div>