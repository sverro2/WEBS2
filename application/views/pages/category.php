<div id="catleft">
	<div class="cat_container">
		<a href="index.php" id="backbutton"> <h1><< BACK</h1> </a>
		<?php

		    /*
		    echo PHP_EOL . "<div class='categoryimage'>";
		    echo PHP_EOL . "<h1> " . $category_data['label'] . "</h1>";
		    echo PHP_EOL . "<img src='" . $category_data['thumbnail'] . "'>";
		    echo PHP_EOL . "</div>";
            */
            echo PHP_EOL . "<div class='categoryimage' style='background-image: url(" . $category_data['thumbnail'] . ")'>";
            echo PHP_EOL . "<h1>" . $category_data['label'] . "</h1>";
            echo PHP_EOL . "</div>";

		?>
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