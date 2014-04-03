<?php
    if(isset($_SESSION['shopping_cart']))
    {
        $admin = $_SESSION['shopping_cart']->is_admin();
    }else{
        $admin=false;
    }
?>

<div id="catleft">
	<div class="cat_container">
		<div id="backbutton"> <h1><< BACK</h1> </div>
		<?php
		if(isset($menu_array))
		{
       		echo "<div class='categoryimage' style='background-image: url(" . $menu_array['thumbnail'] . ")'>";
       		echo "<h1 id='cat_title'>" . $menu_array['label'] . "</h1>";
       	}else{
       		echo "<div class='categoryimage' style='background-image: url(img/addcategory.png)'>";
       		echo "<h1 id='cat_title'>New</h1>";
       	}
   		?>
       		</div>
	</div>
</div>
<div id="catmain">
	<?php
		if(isset($menu_array))
		{
       		echo "<input type='text' placeholder='Name' id='cat_edit_namefield' value='" . $menu_array['label'] . "'/><br/>";
       	}else{
       		echo "<input type='text' placeholder='Name' id='cat_edit_namefield'/><br/>";
  	}
   	?>
	<form action="application/models/upload.php" id="catimg_form" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="catimg"><br>
	</form>
       <input id="catimg_submit" type="submit" name="submit" value="Submit">
</div>