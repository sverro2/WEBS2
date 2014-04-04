<?php
if (isset($_SESSION['shopping_cart'])) {
    $admin = $_SESSION['shopping_cart']->is_admin();
} else {
    $admin = false;
}
?>

<div id="catleft">
    <div class="cat_container">
        <div id="backbutton"> <h1><< BACK</h1> </div>
        <?php
        /*
          echo PHP_EOL . "<div class='categoryimage'>";
          echo PHP_EOL . "<h1> " . $category_data['label'] . "</h1>";
          echo PHP_EOL . "<img src='" . $category_data['thumbnail'] . "'>";
          echo PHP_EOL . "</div>";
         */
        echo PHP_EOL . '<div class="categoryimage" style="background-image: url(';
        echo "'" . $category_data['thumbnail'] . "')";
        echo '">';
        echo PHP_EOL . "<h1>" . $category_data['label'] . "</h1>";
        echo PHP_EOL . "</div>";
        ?>
    </div>
</div>
<div id="catmain">
    <span id="searchmsg"><?php
        if (isset($search)) {
            echo "<b>" . $search['results'] . "</b> search results found for \"<b>" . $search['term'] . "</b>\"";
        }
        ?></span>
        <?php
    if ($admin) {
        echo PHP_EOL . "<div class='productrow'>";
        echo PHP_EOL . "<a href='?route=admin/product_add' class='productlink'>";
        echo PHP_EOL . "<img src='img/product_add.png' class='thumb'>";
        echo "<div class='description'><h1>New</h1>Add a new product!</div>";
        echo PHP_EOL . "</a></div>";
    }

    if (is_array($product_array) && count($product_array) > 0) {
        foreach ($product_array as $row) {
            echo PHP_EOL . "<div class='productrow'>";
            if ($admin) {
                echo "<a class='edit' href='?route=admin/edit_product/" . $row['id'] . "'></a>";
            }
            echo PHP_EOL . "<a href='?route=category/product/" . $row['id'] . "' class='productlink'>";
            echo PHP_EOL . "<img src='img/" . $row['defaultimage'] . "' class='thumb'>";
            echo "<div class='description'><h1>" . $row['title'] . "</h1>" . $row['fullname'] . "</div>";
            echo "<div class='price'>";
            echo "<h1>&euro;" . $row['price'] . "</h1> ";
            echo "</div></a>";
            echo '<a href="#" class="add_item_to_shoppingcart" data-product="' . $row['id'] . '">';
            if ($is_in_cart[$row['id']]) {
                echo 'Added to cart';
            } elseif ($is_in_stock[$row['id']] == 0) {
                echo 'Sorry, Out of stock';
            } else {
                echo 'Add to shoppingcart';
            }
            echo "</a>";
            echo PHP_EOL . "</div>";
        }
    }
    ?>
</div>