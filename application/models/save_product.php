<?php

$product_information_to_save = json_decode($_POST['save_product']);

foreach($product_information_to_save  as $key => $value){
    switch ($key){
        case 'upload_info':
            echo 'Lets upload some info!';
            break;
        case 'other_stuff':
            echo "and do something else";
            break;
        default:
            echo 'no action';
    }
}

