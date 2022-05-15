<?php

session_start();
require_once '../../../models/Category.php';

$errors = array();
$objCat = new Category();

if (isset($_GET['delete'])) {
    try {
        $categoryID = $_GET['delete'];
        $objCat->categoryID = $categoryID;
        $objCat->deleteCategory();
        $msg = "Category deleted successfully.";
        $_SESSION['msg'] = $msg;
    } catch (Exception $ex) {
        $msgErr = $ex->getMessage();
        $_SESSION['msgErr'] = $msgErr;
    }
    header("Location: ../categories.php");
    die;    //if not include - category.php page shows exception errors
}

try {
    $objCat->categoryName = $_POST['categoryName'];
} catch (Exception $ex) {
    $errors['categoryName'] = $ex->getMessage();
}
try {
    $objCat->parentCategory = $_POST['parentCategory'];
} catch (Exception $ex) {
    $errors['parentCategory'] = $ex->getMessage();
}

if (!count($errors)) {
    if (isset($_POST['addCategory'])) {
        try {
            $objCat->addCategory();
            $msg = "Category added successfully.";
            $_SESSION['msg'] = $msg;
        } catch (Exception $ex) {
            $msgErr = $ex->getMessage();
            $_SESSION['msgErr'] = $msgErr;
        }
    } else if (isset($_POST['updateCategory'])) {
        try {
            $cateogryID = $_POST['categoryID'];
            $objCat->categoryID = $cateogryID;
            $objCat->updateCategory();
            $msg = "Category updated successfully.";
            $_SESSION['msg'] = $msg;
        } catch (Exception $ex) {
            $msgErr = $ex->getMessage();
            $_SESSION['msgErr'] = $msgErr;
        }
    }
    header("Location:../categories.php");
} else {
    $msg = "*Check your errors";
    $_SESSION['msg'] = $msg;
    $_SESSION['errors'] = $errors;
//    $_SESSION['objCat'] = $objCat;
    header("Location:../categories.php");
}
?>