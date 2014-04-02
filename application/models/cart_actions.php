<?php
require 'session.class.php';
session_start();
ini_set('display_errors', 1);

foreach (array_keys($_POST) as $item){
    $value = filter_var($_POST[$item], FILTER_VALIDATE_INT);
    
    if($value){
        $_SESSION['shopping_cart']->amount_cart($item, $_POST[$item]);
    }
}
