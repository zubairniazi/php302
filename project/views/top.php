<?php
session_start();

// $_SERVER contains information about header, paths and script locations
define("BASE_URL", "http://" . $_SERVER['HTTP_HOST'] . "/" . "php302/project/");
define("ITEM_PER_PAGE", 6);

if (isset($_COOKIE['objUser'])) {
    $_SESSION['objUser'] = $_COOKIE['objUser'];
}
if (isset($_SESSION['objUser'])) {
    $objUser = unserialize($_SESSION['objUser']);
} 
else {
    $objUser = new User();
}

if (isset($_SESSION['objCart'])) {
    $objCart = unserialize($_SESSION['objCart']);
} else {
    $objCart = new Cart();
}

// $_SERVER['PHP_SELF'] returns the currently executing script filename
$current = $_SERVER['PHP_SELF'];

$publicPages = array(
    "/php302/project/login.php",
    "/php302/project/signup.php",
    "/php302/project/users/forgotPassword.php"
);

$restrictedPages = array(
    "/php302/project/users/myAccount.php",
    "/php302/project/users/editAccount.php",
    "/php302/project/users/resetPassword.php",
    "/php302/project/users/changePassword.php",
    "/php302/project/products/myOrders.php"
);

if ($objUser->login && in_array($current, $publicPages)) {
    $_SESSION['refURL'] = "http://" . $_SERVER['HTTP_HOST'] . $current;
    $_SESSION['msg'] = "You must <a href='" . BASE_URL . "process/processLogout.php' >Logout</a> to view this page";
    header("Location:" . BASE_URL . "msg.php");
}
if (!$objUser->login && in_array($current, $restrictedPages)) {
    $_SESSION['refURL'] = "http://" . $_SERVER['HTTP_HOST'] . $current;
    $_SESSION['msg'] = "You must <a href='" . BASE_URL . "login.php'>Login</a> to view this page";
    header("Location:" . BASE_URL . "msg.php");
}
?>

<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo(BASE_URL); ?>css/bootstrap.css" media="all" rel="stylesheet" />
        <link href="<?php echo(BASE_URL); ?>css/style.css" media="all" rel="stylesheet" />
        <script src="<?php echo(BASE_URL); ?>js/jquery-2.2.3.min.js"></script>
        <script src="<?php echo(BASE_URL); ?>js/bootstrap.js"></script>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo(BASE_URL); ?>e-shop-icon.ico" />
        <title>E Shop &#45; Online Shopping</title>