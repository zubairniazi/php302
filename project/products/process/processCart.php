<?php

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
//die;


session_start();

require_once '../../models/Cart.php';
if (isset($_SESSION['objCart'])) {
    $objCart = unserialize($_SESSION['objCart']);
} else {
    $objCart = new Cart();
}


if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'addToCart':
            $item = new Item($_POST['productID']);
            $objCart->addToCart($item);
            break;
        case 'updateCart':
            $objCart->updateCart($_POST['qtys']);
            break;
    }
} else if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'removeItem':
            $item = new Item($_GET['itemID']);
            $objCart->removeItem($item);
            break;
        case 'emptyCart':
            $objCart->emptyCart();
            break;
    }
}

$_SESSION['objCart'] = serialize($objCart);

header("Location:" . $_SERVER['HTTP_REFERER']);
