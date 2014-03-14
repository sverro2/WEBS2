<div class="centered_inline_block">
    <div id="cat_container">
    <?php
        $categories_sql_string = "SELECT * FROM category";

        require_once('./class/database.class.php');
        $connection = new Database("sbrettsc_db");

        $menu_array = $connection->get_array_from_query($categories_sql_string);

        foreach ($menu_array as $row){

            echo PHP_EOL . "<a href='#' class='menuitem' data-page='pages/category.php' data-parameter='" . $row['id'] . "'>";
            echo PHP_EOL . "<div class='categoryimage' style='background-image: url(" . $row['thumbnail'] . ")'>";
            echo PHP_EOL . "<h1>" . $row['label'] . "</h1>";
            echo PHP_EOL . "</div>";
            echo PHP_EOL . "</a>";

        }
    ?>
    </div>
</div>
