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
        $resetCode = $_POST['resetCode'];
        $objUser->email = $_POST['email'];
        $objUser->changeForgotPassword($resetCode);
        $msg = "Your password successfully changed. Click to <a href='login.php'>Login</a>";
        $_SESSION['msg'] = $msg;
    } catch (Exception $ex) {
        $msgErr = $ex->getMessage();
        $_SESSION['msgErr'] = $msgErr;
    }
    header("Location:../msg.php");
} else {
    $msg = "<p class='bg-danger'>*Check your error</p>";
    $_SESSION['msg'] = $msg;
    $_SESSION['errors'] = $errors;
    header("Location: ../users/changePassword.php");
}
