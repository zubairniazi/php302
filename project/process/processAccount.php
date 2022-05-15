<?php

session_start();
require_once '../models/User.php';

$errors = array();
if (isset($_SESSION['objUser'])) {
    $objUser = unserialize($_SESSION['objUser']);
} else {
    $objUser = new User();
//    $msgErr = "Please, <a href='login.php' > Login</a> to view this page!";
//    $_SESSION['msgErr'] = $msgErr;
//    header("Location: ../msg.php");
//    die;
}

try {
    $objUser->firstName = $_POST['firstName'];
} catch (Exception $ex) {
    $errors['firstName'] = $ex->getMessage();
}
try {
    $objUser->middleName = $_POST['middleName'];
} catch (Exception $ex) {
    $errors['middleName'] = $ex->getMessage();
}
try {
    $objUser->lastName = $_POST['lastName'];
} catch (Exception $ex) {
    $errors['lastName'] = $ex->getMessage();
}
//try {
//    $objUser->email = $_POST['email'];
//} catch (Exception $ex) {
//    $errors['email'] = $ex->getMessage();
//}
//try {
//    $objUser->userName = $_POST['userName'];
//} catch (Exception $ex) {
//    $errors['userName'] = $ex->getMessage();
//}
//try {
//    $objUser->password = $_POST['password'];
//} catch (Exception $ex) {
//    $errors['password'] = $ex->getMessage();
//}
//try {
//    User::comparePasswords($_POST['password'], $_POST['password2']);
//} catch (Exception $ex) {
//    $errors['password2'] = $ex->getMessage();
//}
try {
    $objUser->contactNumber = $_POST['contactNumber'];
} catch (Exception $ex) {
    $errors['contactNumber'] = $ex->getMessage();
}
try {
    $objUser->gender = isset($_POST['gender']) ? $_POST['gender'] : NULL;
} catch (Exception $ex) {
    $errors['gender'] = $ex->getMessage();
}
try {
    $objUser->interests = isset($_POST['interests']) ? $_POST['interests'] : NULL;
} catch (Exception $ex) {
    $errors['interests'] = $ex->getMessage();
}
try {
    $objUser->dateOfBirth = $_POST['dateOfBirth'];
} catch (Exception $ex) {
    $errors['dateOfBirth'] = $ex->getMessage();
}
try {
    $objUser->streetAddress = $_POST['streetAddress'];
} catch (Exception $ex) {
    $errors['streetAddress'] = $ex->getMessage();
}
try {
    $objUser->city = $_POST['city'];
} catch (Exception $ex) {
    $errors['city'] = $ex->getMessage();
}
try {
    $objUser->state = $_POST['state'];
} catch (Exception $ex) {
    $errors['state'] = $ex->getMessage();
}
try {
    $objUser->country = $_POST['country'];
} catch (Exception $ex) {
    $errors['country'] = $ex->getMessage();
}
try {
    $objUser->profileImage = $_FILES['profileImage'];
} catch (Exception $ex) {
    $errors['profileImage'] = $ex->getMessage();
}

//$_SESSION['objUser'] = serialize($objUser);

if (count($errors) == 0) {
    try {
//        $actCode = md5(crypt(rand()));
        $objUser->updateProfile();
        $msg = "Account Updated! <a href='http://localhost/php302/project/users/myAccount.php'>Click to view</a>";
        $_SESSION['msg'] = $msg;
//        $objUser->sendMail();
        header("Location:../msg.php");
        $objUser->uploadProfileImage($_FILES['profileImage']['tmp_name']);
    } catch (Exception $ex) {
        $_SESSION['msgErr'] = $ex->getMessage();
        header("Location:../users/myAccount.php");
    }
} else {
    $msg = "*Check your errors";
    $_SESSION['msg'] = $msg;
    $_SESSION['errors'] = $errors;
    $_SESSION['objUser'] = serialize($objUser);
    header("Location:../users/myAccount.php");
}
