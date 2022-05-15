<?php

session_start();
require_once '../../../models/Admin.php';

$errors = array();
$objAdmin = new Admin();

try {
    $objAdmin->adminEmail = $_POST['adminEmail'];
} catch (Exception $ex) {
    $errors['adminEmail'] = $ex->getMessage();
}

try {
    $objAdmin->adminPassword = $_POST['adminPassword'];
} catch (Exception $ex) {
    $errors['adminPassword'] = $ex->getMessage();
}

if (count($errors) == 0) {
    try {
        $remember = isset($_POST['remember']) ? TRUE : FALSE;

        if (isset($_SESSION['refURL'])) {
            $refURL = $_SESSION['refURL'];
            unset($_SESSION['refURL']);
            header("Location:$refURL");
        }
//        else {
        $objAdmin->login($remember);
        header("Location:../../index.php");
//        }
    } catch (Exception $ex) {
        $_SESSION['msgErr'] = $ex->getMessage();
        header("Location:../login.php");
    }
} else {
    $msg = "*Check your errors";
    $_SESSION['msg'] = $msg;
    $_SESSION['errors'] = $errors;
    $_SESSION['objAdmin'] = serialize($objAdmin);
    header("Location:../login.php");
}
?>