<?php

session_start();
require_once '../../models/Order.php';
require_once '../../models/User.php';
require_once '../../models/Cart.php';
require_once '../../models/DBConnection.php';

if (isset($_SESSION['objCart'])) {
    $objCart = unserialize($_SESSION['objCart']);
} else {
    $msg = "Trying to place order, first choose some products. <a href='index.php'>Click to Shop</a>";
    $_SESSION['msg'] = $msg;
    die(header("Location:../../msg.php"));
}

if (isset($_SESSION['objUser'])) {
    $objUser = unserialize($_SESSION['objUser']);
} else {
    $msg = "Please <a href='login.php'>Login</a> to continue.";
    $_SESSION['msg'] = $msg;
    die(header("Location:../../msg.php"));
}

$objContact = new User();
$errors = array();

try {
    $objContact->firstName = $_POST['firstName'];
} catch (Exception $ex) {
    $errors['firstName'] = $ex->getMessage();
}

try {
    $objContact->middleName = $_POST['middleName'];
} catch (Exception $ex) {
    $errors['middleName'] = $ex->getMessage();
}

try {
    $objContact->lastName = $_POST['lastName'];
} catch (Exception $ex) {
    $errors['lastName'] = $ex->getMessage();
}

try {
    $objContact->contactNumber = $_POST['contactNumber'];
} catch (Exception $ex) {
    $errors['contactNumber'] = $ex->getMessage();
}

try {
    $objContact->streetAddress = $_POST['streetAddress'];
} catch (Exception $ex) {
    $errors['streetAddress'] = $ex->getMessage();
}
try {
    $objContact->city = $_POST['city'];
} catch (Exception $ex) {
    $errors['city'] = $ex->getMessage();
}

try {
    $objContact->state = $_POST['state'];
} catch (Exception $ex) {
    $errors['state'] = $ex->getMessage();
}

try {
    $objContact->country = $_POST['country'];
} catch (Exception $ex) {
    $errors['country'] = $ex->getMessage();
}


if (count($errors) == 0) {

    try {
        
        Order::placeOrder($objUser, $objContact, $objCart);

        $_SESSION['msg'] = "<p class='bg-success'>Your order is placed</p>";
        unset($_SESSION['objCart']);
    } catch (Exception $ex) {
        $_SESSION['msgErr'] = $ex->getMessage();
    }


    header("Location:../../msg.php");
} else {
    $msg = "*Check your errors";
    $_SESSION['msg'] = $msg;
    $_SESSION['errors'] = $errors;
    $_SESSION['objContact'] = serialize($objContact);

    header("Location:../checkOut.php");
}
?>