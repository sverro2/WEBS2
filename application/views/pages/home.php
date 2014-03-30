<div class="centered_inline_block">
    <div id="cat_container">
    <?php
        

        foreach ($menu_array as $row){

            echo PHP_EOL . "<a href='?route=category/show/" . $row['url'] . "' class='menuitem' data-page='pages/category.php' data-parameter='" . $row['id'] . "'>";
            echo PHP_EOL . "<div class='categoryimage' style='background-image: url(" . $row['thumbnail'] . ")'>";
            echo PHP_EOL . "<h1>" . $row['label'] . "</h1>";
            echo PHP_EOL . "</div>";
            echo PHP_EOL . "</a>";

        }
    ?>
    </div>
</div>
