<?php
if (isset($_SESSION['shopping_cart'])) {
    $admin = $_SESSION['shopping_cart']->is_admin();
} else {
    $admin = false;
}
?>

<div id="catleft">
	<div class="cat_container">
		<a href="index.php" id="backbutton"> <h1><< BACK</h1> </a>
		<div class='categoryimage' style='background-image: url("img/defaultcategory.png")'>
                    <h1>About Us</h1>
                </div>	
        </div>
</div>

<div id="catmain" class="about">
    <?php
        if($admin){
            echo "<a class='edit right' id='aboutedit' href='#'></a>";
        }
    ?>
    <h1>About Aperture Science</h1>
    <div id="abouttext">
        <br/>
        <?php
            echo $about['text'];
        ?>
    </div>
</div>