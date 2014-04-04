<?php
//will simple restart the session and empty the cart on buying
session_start();
session_destroy();
