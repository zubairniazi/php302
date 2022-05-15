<?php

session_start();
require_once '../../../models/Brand.php';

$errors = array();
$objBrand = new Brand();

if (isset($_GET['delete'])) {
    try {
        $brandID = $_GET['delete'];
        $objBrand->brandID = $brandID;
        $objBrand->deleteBrand();
        $msg = "Brand deleted successfully.";
        $_SESSION['msg'] = $msg;
    } catch (Exception $ex) {
        $msgErr = $ex->getMessage();
        $_SESSION['msgErr'] = $msgErr;
    }
    header("Location: ../brands.php");
    die;       // if not added then brands page gets errors
}

try {
    $objBrand->brandName = $_POST['brandName'];
} catch (Exception $ex) {
    $errors['brandName'] = $ex->getMessage();
}
try {
    $objBrand->brandImage = $_FILES['brandImage'];
} catch (Exception $ex) {
    $errors['brandImage'] = $ex->getMessage();
}


if (!count($errors)) {
    if (isset($_POST['addBrand'])) {
        try {
            $objBrand->addBrand();
            $objBrand->uploadBrandImage($_FILES['brandImage']['tmp_name']);
            $msg = "Brand added successfully.";
            $_SESSION['msg'] = $msg;
        } catch (Exception $ex) {
            $msgErr = $ex->getMessage();
            $_SESSION['msgErr'] = $msgErr;
        }
    } else if (isset($_POST['updateBrand'])) {
        try {

            $brandID = $_POST['brandID'];
            $objBrand->brandID = $brandID;
            $objBrand->updateBrand();
            $objBrand->uploadBrandImage($_FILES['brandImage']['tmp_name']);
            $msg = "Brand update successfully.";
            $_SESSION['msg'] = $msg;
        } catch (Exception $ex) {
            $msgErr = $ex->getMessage();
            $_SESSION['msgErr'] = $msgErr;
        }
    }
    header("Location:../brands.php");
} else {
    $msg = "*Check your errors";
    $_SESSION['msg'] = $msg;
    $_SESSION['errors'] = $errors;
//    $_SESSION['objBrand'] = $objBrand;
    header("Location:../brands.php");
}
?>