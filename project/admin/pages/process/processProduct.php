<?php

//die("AOA!");

session_start();
require_once '../../../models/Product.php';

$errors = array();
$objProduct = new Product();

if(isset($_GET['delete'])) {
    $pID = $_GET['delete'];
    $objProduct->productID = $pID;
    $objProduct->deleteProduct();
    die(header("Location: ../products.php"));
}


try {
    $objProduct->productName = $_POST['productName'];
} catch (Exception $ex) {
    $errors['productName'] = $ex->getMessage();
}

try {
    $objProduct->brandID = $_POST['brandID'];
} catch (Exception $ex) {
    $errors['brandID'] = $ex->getMessage();
}

try {
    $objProduct->categoryID = $_POST['categoryID'];
} catch (Exception $ex) {
    $errors['categoryID'] = $ex->getMessage();
}

try {
    $objProduct->unitPrice = $_POST['unitPrice'];
} catch (Exception $ex) {
    $errors['unitPrice'] = $ex->getMessage();
}

try {
    $objProduct->quantity = $_POST['quantity'];
} catch (Exception $ex) {
    $errors['quantity'] = $ex->getMessage();
}

try {
    $objProduct->featured = $_POST['featured'];
} catch (Exception $ex) {
    $errors['featured'] = $ex->getMessage();
}

try {
    $objProduct->productFeatures = $_POST['productFeatures'];
} catch (Exception $ex) {
    $errors['productFeatures'] = $ex->getMessage();
}

try {
    $objProduct->description = $_POST['description'];
} catch (Exception $ex) {
    $errors['description'] = $ex->getMessage();
}

try {
    $objProduct->productImage = $_FILES['productImage'];
} catch (Exception $ex) {
    $errors['productImage'] = $ex->getMessage();
}

if (!count($errors)) {
    try {
        if (isset($_POST['addProduct'])) {

            $objProduct->addProduct();
            $objProduct->uploadProductImage($_FILES['productImage']['tmp_name']);
            $msg = "Product successfully added. <a href='products.php'>View all products</a>";
            $_SESSION['msg'] = $msg;
        } else if (isset($_POST['updateProduct'])) {
            $productID = $_POST['productID'];
            $objProduct->productID = $productID;
            $objProduct->updateProduct();
            $objProduct->uploadProductImage($_FILES['productImage']['tmp_name']);
            $msg = "- Product updated.";
            $_SESSION['msg'] = $msg;
        }
    } catch (Exception $ex) {
        $msgErr = $ex->getMessage();
        $_SESSION['msgErr'] = $msgErr;
    }
    if (isset($_POST['updateProduct'])) {
        header("Location: ../products.php?source=edit&pID=$objProduct->productID");
    } else {
        header("Location: ../products.php?source=add");
    }
} else {
    $msg = "*Check your errors";
    $_SESSION['msg'] = $msg;
    $_SESSION['errors'] = $errors;

    if (isset($_POST['updateProduct'])) {
        $productID = $_POST['productID'];
        header("Location:../products.php?source=edit&pID=$productID");
    } else {
        header("Location: ../products.php?source=add");
    }
}
?>
