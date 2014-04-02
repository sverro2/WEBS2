<?php
require 'application/models/session.class.php';
session_start();

$_SESSION['shopping_cart']->set_admin(false);