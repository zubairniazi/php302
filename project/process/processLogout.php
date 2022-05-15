<?php
session_start();
require_once '../models/User.php';

$objUser = unserialize($_SESSION['objUser']);

try {
    $objUser->logout();
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
    header("Location:../msg.php");
}

?>
