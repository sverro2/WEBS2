<?php
ini_set('display_errors',1);
require 'application/models/session.class.php';
session_start();

$_SESSION['shopping_cart']->set_admin(true);