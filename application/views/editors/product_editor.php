<?php
if (isset($_SESSION['shopping_cart'])) {
    $admin = $_SESSION['shopping_cart']->is_admin();
} else {
    $admin = false;
    echo "You need to login first!";
    exit;
}
print_r(get_defined_vars());
?>

<div id="catleft">
    <div class="cat_container">
        <div id="backbutton"> <h1><< BACK</h1> </div>
        <?php
        if (isset($vars['image'])) {
            echo '<div class="categoryimage" style="background-image: url(' . "'img/" . $vars['image'] . "')" . '"></div>';
        }
        ?>
    </div>
</div>

<div id="catmain">
    <div class ='editrow'>
        <h1>Product Information</h1>

        <table>
            <tr>
                <td>Title:</td>
                <td><input type="text" id="title_input" value="<?= $vars['title'] ?>"></td>
            </tr>
            <tr>
                <td>Full Name:</td>
                <td><input type="text"  id="full_name_input" value="<?= $vars['fullname'] ?>"></td>
            </tr>
            <tr>
                <td>Category:</td>
                <td>
                    <select id = "category_input">
                        <?php
                        echo '<option value = "' . $vars['category'] . '">' . $vars['category'] . '</option>' . PHP_EOL;
                        
                        foreach ($vars['categories'] as $category) {
                            if($category != $vars['category']){
                                echo '<option value = "' . $category['label'] . '">' . $category['label'] . '</option>' . PHP_EOL;
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Price (&euro;):</td>
                <td><input type="text"  id="price_input" value="<?= $vars['price'] ?>"></td>
            </tr>
        </table>
        <input type="submit" data-id="<?=$vars['product_id']?>" id="information_submit" value="Save Information">
    </div>
    <div class="editrow">
        <h1>Product Description</h1>
        <textarea id="description"><?= $vars['description'] ?></textarea><br>
        <input type="submit" value="Save Description">
    </div>
    <div class="editrow">
        <h1>Product Thumbnail</h1>
        <img src="img/<?= $vars['image'] ?>" id="thumbnailimage" alt="thumbnail">
        <form action="application/models/upload.php" id="product_thumb_form" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="thumbupload">
        </form>
        <input id="thumb_submit" type="submit" name="submit" value="Upload Thumbnail">
    </div>
    <div class="editrow">
        <h1>Product Features</h1>
        <table>
            <thead>
                <tr>
                    <td>Product Specification</td>
                    <td>Product Specification Value</td>
                    <td>Remove</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($vars['product_specs_array'] as $specdata) {
                    echo "<tr data-id='" . $vars['product_id'] . "'>" . PHP_EOL;
                    echo "<td>" . $specdata['spec'] . "</td>" . PHP_EOL;
                    echo "<td>" . $specdata['spec_value'] . "</td>" . PHP_EOL;
                    echo "<td><a href='#' title='Remove spec'>X</a></td>" . PHP_EOL;
                    echo "</tr>" . PHP_EOL;
                }
                ?>
            </tbody>
        </table>

        <br>
        <h2>Add specifications:</h2>

        <table>
            <thead>
                <tr>
                    <td>Specification</td>
                    <td>Specification Value</td>
                    <td>+</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" id="spec_field" list="speclist">
                        <datalist id="speclist">
                            <?php
                            foreach ($vars['speclist'] as $spec) {
                                echo '<option value="' . $spec['spec'] . '">';
                            }
                            ?>
                        </datalist> 
                    </td>
                    <td><input type="text" id="spec_value_field"></td>
                    <td><a href="#" title="Add specification to product" id="submit_new_spec">Add</a></td>
                </tr>
            </tbody>
        </table>


    </div>
    <div class="editrow">
        <h1>Product Images</h1>
        <table>
            <thead>
                <tr>
                    <td>Preview</td>
                    <td>URL</td>
                    <td>Remove</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($vars['product_images_array'] as $image){
                    echo "<tr>" . PHP_EOL;
                    echo '<td><img src="img/' . $image['url'] . '"  width="90" height="90"></td>';
                    echo '<td>'.$image['url'].'</td>';
                    echo '<td><a href="#" class="remove_image">X</a></td>';
                    echo "</tr>" . PHP_EOL;
                }
                    
                ?>
            </tbody>
        </table>
        <br>
        <h2>Add an Image</h2>
        <form action="application/models/upload.php" id="product_image_form" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="imageupload">
        </form>
        <input id="image_submit" type="submit" name="submit" value="Upload Image">
    </div>
    <div class="editrow">
        <h1>Product Videos</h1>
        <table>
            <thead>
                <tr>
                    <td>Preview</td>
                    <td>Link</td>
                    <td>Remove</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($vars['product_videos_array'] as $video){
                    echo "<tr>" . PHP_EOL;
                    echo '<td><img src="http://img.youtube.com/vi/' . $video['url'] . '/2.jpg"  width="90" height="90"></td>';
                    echo '<td><a href="https://www.youtube.com/watch?v=' . $video['url'] . '">Watch</a></td>';
                    echo '<td><a href="#" class="remove_video">X</a></td>';
                    echo "</tr>" . PHP_EOL;
                }
                    
                ?>
            </tbody>
        </table>
        <br>
        <h2>Add an Video (paste Youtube URL)</h2>
        <input type="text" id="video_input"><br>
        <input type="submit" id="submit_video" value="Add Video">
    </div>
</div>