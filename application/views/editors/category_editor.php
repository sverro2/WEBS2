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
       		echo '<div class="categoryimage" style="background-image: url(' . "'" . $menu_array['thumbnail'] . "')" . '"';
                echo " data-img='" . $menu_array['thumbnail'] . "' data-id=" . $menu_array['id'] . ">";
       		echo "<h1 id='cat_title' data-title='" . $menu_array['label'] . "'>" . $menu_array['label'] . "</h1>";
       	}else{
       		echo "<div class='categoryimage' style='background-image: url(img/defaultcategory.png)' data-img='defaultcategory.png' data-id=0>";
       		echo "<h1 id='cat_title' data-title='New'>New</h1>";
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
          echo "<input type='text' placeholder='url' id='cat_edit_urlfield' value='" . $menu_array['url'] . "'/><br/>";
       	}else{
       		echo "<input type='text' placeholder='Name' id='cat_edit_namefield'/><br/>";
          echo "<input type='text' placeholder='url' id='cat_edit_urlfield'/><br/>";
  	}
   	?>
	<form action="application/models/upload.php" id="catimg_form" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="catimg">
	</form>
   	<input id="catimg_submit" type="submit" name="submit" value="Upload">
   	<br/>
	<input id="cat_save" type="submit" name="submit" value="Save">
</div>