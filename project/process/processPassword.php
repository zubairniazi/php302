<?php

session_start();
require_once '../models/User.php';

if (isset($_SESSION['objUser'])) {
    $objUser = unserialize($_SESSION['objUser']);
} else {
    $objUser = new User();
}
$errors = array();

try {
    $userID = $objUser->userID;
    $userName = $objUser->userName;
    User::checkPassword($_POST['currentPassword'],$userID,$userName);
} catch (Exception $ex) {
    $errors['currentPassword'] = $ex->getMessage();
}
try {
    $objUser->password = $_POST['password'];
} catch (Exception $ex) {
    $errors['password'] = $ex->getMessage();
}
try {
    User::comparePasswords($_POST['password'], $_POST['password2']);
} catch (Exception $ex) {
    $errors['password2'] = $ex->getMessage();
}


if (count($errors) == 0) {
    try {
        $objUser->changePassword();
        $msg = "<p class='bg-success'>Password successfully changed.</p>";
        $_SESSION['msg'] = $msg;
    } catch (Exception $ex) {
        $msgErr = $ex->getMessage();
        $_SESSION['msgErr'] = $msgErr;
    }
    header("Location: ../users/resetPassword.php");
} else {
    $msg = "<p class='bg-danger'>*Check your errors</p>";
    $_SESSION['msg'] = $msg;
    $_SESSION['errors'] = $errors;
    header("Location: ../users/resetPassword.php");
}
