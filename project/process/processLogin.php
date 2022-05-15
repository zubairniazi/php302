<?php

session_start();
require_once '../models/User.php';

$errors = array();
$objUser = new User();

try {
    $objUser->userName = $_POST['userName'];
} catch (Exception $ex) {
    $errors['userName'] = $ex->getMessage();
}
try {
    $objUser->password = $_POST['password'];
} catch (Exception $ex) {
    $errors['password'] = $ex->getMessage();
}

if (count($errors) == 0) {
    try {

        $remember = isset($_POST['remember']) ? TRUE : FALSE;
        $objUser->login($remember);

        if (isset($_SESSION['refURL'])) {
            $refURL = $_SESSION['refURL'];
            unset($_SESSION['refURL']);
            header("Location:$refURL");
        } else {
            header("Location:../index.php");
        }
    } catch (Exception $ex) {
        $_SESSION['msgErr'] = $ex->getMessage();
        header("Location:../login.php");
    }
} else {
    $msg = "*Check your errors";
    $_SESSION['msg'] = $msg;
    $_SESSION['errors'] = $errors;
    $_SESSION['objUser'] = serialize($objUser);
    header("Location:../login.php");
}
?>