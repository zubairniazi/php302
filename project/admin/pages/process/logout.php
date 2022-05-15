<?php

session_start();
require_once '../../../models/Admin.php';

$objAdmin = unserialize($_SESSION['objAdmin']);

try {
    $objAdmin->logout();

    if (isset($_SESSION['refURL'])) {
        $refURL = $_SESSION['refURL'];
        unset($_SESSION['refURL']);
        header("Location:$refURL");
    } else {
        $_SESSION['msg'] = "You have logged out";
        header("Location:../msg.php");
    }
} catch (Exception $ex) {
    $_SESSION['msgErr'] = $ex->getMessage();
    header("Location:../pages/msg.php");
}
?>
