<div id="catleft">
	<div class="cat_container">
            <a href="index.php" id="backbutton"></a>

		    
            
            <div class='categoryimage' style='background-image: url(img/shoppingcart.png)'>
            <h1>Cart</h1>
            </div>
	</div>
</div>
<div id="catmain">
	<?php
                $total_price = 0;
                foreach($vars as $row)
                {
                        $total_price += $row['price']*$row['amount_in_cart'];
                        echo PHP_EOL . "<div class='productrow'>";
                        echo PHP_EOL . "<a href='?route=category/product/" . $row['product_id'] . "' class='productlink'>";
                        echo PHP_EOL . "<img src='img/" . $row['image'] . "' class='thumb'>";
                        echo "<div class='description'><h1>" . $row['title'] . "</h1>" . $row['fullname'] . ' (x' . $row['amount_in_cart'] . ')<br>' . 
                                "Product cost (quantity of one): &euro;" . $row['price'] ."</div></a>";
                        echo 'Amount: <input type="number" min="0" max="10"  data-product="' . $row['product_id'] . '" value=' . $row['amount_in_cart'] . ">";
                        echo PHP_EOL . "</div>";
                }
                
                echo '<div>Total cost: &euro;' . $total_price . "</div>";
	?>
    <input type="button" name="commit" value="Commit Changes">
    <input type="button" onclick="alert('thanks for buying our stuff!'); location.href='application/models/buy.php';" name="buy" value="Buy">
</div>