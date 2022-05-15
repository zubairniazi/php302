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
    $objUser->email = $_POST['email'];
} catch (Exception $ex) {
    $errors['email'] = $ex->getMessage();
}




if (count($errors) == 0) {
    try {
        $resetCode = md5(crypt(rand(), 'abc'));
//        $msg = "Please check your email address.";
//        $subject = "Password Change Request";
        $objUser->resetCode($resetCode);
        $msg = "Click to below link to change your password.<br>"
                . "<a href='http://localhost/php302/project/users/changePassword.php?email=$objUser->email&resetCode=$resetCode'>Click Here</a>"
                . "<br><br>*If you did not submit this request, please ignor this message.";
//        $objUser->sendChangePasswordMail();
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
    header("Location: ../users/forgotPassword.php");
}
