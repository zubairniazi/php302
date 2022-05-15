<?php

session_start();
require_once '../../../models/Admin.php';

$errors = array();
$objAdmin = new Admin();


if(isset($_GET['delete'])) {
    $adminID = $_GET['delete'];
    try {
        $objAdmin->adminID = $adminID;
        $objAdmin->deleteAdmin();
        $msg = "Dashboard user successfully deleted.";
        $_SESSION['msg'] = $msg;
    } catch (Exception $ex) {
        $msgErr = $ex->getMessage();
        $_SESSION['msgErr'] = $msgErr;
    }
    header("Location: ../users.php?source=dbuser");
    die;
}

try {
    $objAdmin->adminName = $_POST['adminName'];
} catch (Exception $ex) {
    $errors['adminName'] = $ex->getMessage();
}
try {
    $objAdmin->adminRole = $_POST['adminRole'];
} catch (Exception $ex) {
    $errors['adminRole'] = $ex->getMessage();
}
try {
    $objAdmin->adminEmail = $_POST['adminEmail'];
} catch (Exception $ex) {
    $errors['adminEmail'] = $ex->getMessage();
}
try {
    $objAdmin->adminPassword = $_POST['adminPassword'];
} catch (Exception $ex) {
    $errors['adminPassword'] = $ex->getMessage();
}

if (!count($errors)) {
    try {
        if (isset($_POST['addAdmin'])) {
            $objAdmin->addAdmin();
            $msg = "Dashoard User added successfully.";
            $_SESSION['msg'] = $msg;
        }
    } catch (Exception $ex) {
        $msgErr = $ex->getMessage();
        $_SESSION['msgErr'] = $msgErr;
    }
    header("Location: ../users.php?source=add");
} else {
    $msg = "*Check your errors!";
    $_SESSION['msg'] = $msg;
    $_SESSION['errors'] = $errors;
    header("Location: ../users.php?source=add");
}