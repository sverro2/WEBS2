<?php
if (isset($_SESSION['shopping_cart'])) {
    $admin = $_SESSION['shopping_cart']->is_admin();
} else {
    $admin = false;
}
?>
<div class="centered_inline_block">
    <div id="cat_container">
        <?php
        foreach ($menu_array as $row) {


            echo PHP_EOL . '<div class="categoryimage" style="background-image: url(';
            echo "'" . $row['thumbnail'] . "')";
            echo '">';
            echo PHP_EOL . "<a href='?route=category/show/" . $row['url'] . "' class='menuitem link'>";

            echo PHP_EOL . "<h1>" . $row['label'] . "</h1>";
            echo PHP_EOL . "</a>";
            if ($admin) {
                echo "<a href='?route=admin/edit_category/" . $row['id'] . "' class='editlink'>";
                echo PHP_EOL . "<h1 class='edit'>edit</h1>";
                echo PHP_EOL . "</a>";
            }
            echo PHP_EOL . "</div>";
        }

        if ($admin) {
            echo PHP_EOL . "<a href='?route=admin/add_category' class='menuitem'>";
            echo PHP_EOL . "<div class='categoryimage' style='background-image: url(img/addcategory.png)'>";
            echo PHP_EOL . "<h1>Add</h1>";
            echo PHP_EOL . "</div>";
            echo PHP_EOL . "</a>";
        }
        ?>
    </div>
</div>
