<?php

session_start();
require_once '../../../models/User.php';

$objUser = new User();

if (isset($_GET['delete'])) {
    $userID = $_GET['delete'];
    try {
        $objUser->userID = $userID;
        $objUser->deleteUser();
        $msg = "Account successfully deleted.";
        $_SESSION['msg'] = $msg;
    } catch (Exception $ex) {
        $msgErr = $ex->getMessage();
        $_SESSION['msgErr'] = $msgErr;
    }
}
header("Location: ../users.php");
