<?php
require 'application/models/session.class.php';
session_start();
//session_destroy();
//print_r($_SESSION['shopping_cart']->get_cart());

$uri = array();
if (isset($_GET['route'])) {
    $array_tmp_uri = preg_split('[\\/]', $_GET['route'], -1, PREG_SPLIT_NO_EMPTY);
    $uri['controller'] = @ $array_tmp_uri[0];
    $uri['method'] = @ $array_tmp_uri[1];
    $uri['var'] = @ $array_tmp_uri[2];
} else {
    $uri['controller'] = "home";
    $uri['method'] = "index";
    $uri['var'] = "";
}

if ($uri['controller'] == 'admin') {
    if (!isset($uri['method'])) {
        $uri['method'] = "index";
    }

    $show_admin = true;
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Aperture Science</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="http://yandex.st/json2/2011-10-19/json2.min.js"></script>
        <script type="text/javascript" src="js/jquery.form.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </head>
    <body>
        <div id="top_container"></div>
        <a href="index.php"> <header></header></a>
        <menu>

            <div id="menu_alignment">
<?php
include 'application/views/elements/menu.class.php';

$menu_creator = new Structure();
$menu_creator->display_menu();
?>
            </div>
        </menu>

        <div id="content">
<?php
$menu_creator->display_breadcrumbs($_SERVER['REQUEST_URI']);

//Load config and base 
require_once("application/base.php");
$application = new application($uri);
?>
        </div>  

        <footer></footer>
    </body>
</html>
