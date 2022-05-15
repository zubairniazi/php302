<?php
session_start();
define("BASE_URL", "http://" . $_SERVER['HTTP_HOST'] . "/" . "php302/project/admin/");

if (isset($_COOKIE['objAdmin'])) {
    $_SESSION['objAdmin'] = $_COOKIE['objAdmin'];
}
if (isset($_SESSION['objAdmin'])) {
    $objAdmin = unserialize($_SESSION['objAdmin']);
} else {
    $objAdmin = new Admin();
}

$current = $_SERVER['PHP_SELF'];

$publicPages = array("/php302/project/admin/pages/login.php");

$restrictedPages = array("/php302/project/admin/index.php",
    "/php302/project/admin/pages/index.php",
    "/php302/project/admin/pages/addProduct.php",
    "/php302/project/admin/pages/viewProducts.php",
    "/php302/project/admin/pages/brands.php",
    "/php302/project/admin/pages/msg.php",
    "/php302/project/admin/siteTemplate"
);


if ($objAdmin->login && in_array($current, $publicPages)) {
    $_SESSION['refURL'] = "http://" . $_SERVER['HTTP_HOST'] . $current;
    $_SESSION['msg'] = "You must <a href='" . BASE_URL . "process/logout.php' >Logout</a> to view this page";
    header("Location:./msg.php");
}

if (!$objAdmin->login && in_array($current, $restrictedPages)) {
//if (!$objAdmin->login) {  // if added, pages are not redirect properly
    header("Location:./login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin - E Shop</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo(BASE_URL); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo(BASE_URL); ?>vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo(BASE_URL); ?>dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="<?php echo(BASE_URL); ?>vendor/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo(BASE_URL); ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
