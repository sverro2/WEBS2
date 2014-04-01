<?php
require 'session.class.php';
session_start();
ini_set('display_errors', 1);

foreach (array_keys($_POST) as $item){
    $_SESSION['shopping_cart']->amount_cart($item, $_POST[$item]);
    echo $item;
}
