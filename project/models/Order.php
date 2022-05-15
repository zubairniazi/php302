<?php

require_once 'DBConnection.php';
require_once 'User.php';
require_once 'Cart.php';

class Order extends DBConnection {

    public static function placeOrder($objUser, $objContact, $objCart) {
        $objDB = self::objDB();

        $queryInsertAddress = "INSERT INTO `addresses` "
                . "(`addressID`, `firstName`, `middleName`, `lastName`, "
                . "`streetAddress`, `city`, `state`, `country`, "
                . "`contactNumber`, `userID`) "
                . "VALUES "
                . "(NULL, '$objContact->firstName', '$objContact->middleName', '$objContact->lastName', "
                . "'$objContact->streetAddress', '$objContact->country', '$objContact->state', '$objContact->country', "
                . "'$objContact->contactNumber', '$objUser->userID');";

        $resultAddress = $objDB->query($queryInsertAddress);
        $addressID = $objDB->insert_id;

        $now = date("Y-m-d H:i:s");
        $queryInsertOrder = "INSERT INTO `order` "
                . "(`orderID`, `userID`, `orderDate`, "
                . "`orderStatus`, `addressID`) "
                . "VALUES "
                . "(NULL, '$objUser->userID', '$now', "
                . "'pending', '$addressID');";

        $resultOrder = $objDB->query($queryInsertOrder);
        $orderID = $objDB->insert_id;

        foreach ($objCart->items as $item) {

            $queryInsertItem = "INSERT INTO `orderitem` "
                    . "(`orderItemID`, `orderID`, `productID`, "
                    . "`unitPrice`, `quantity`) "
                    . "VALUES "
                    . "(NULL, '$orderID', '$item->itemID', "
                    . "'$item->unitPrice', '$item->quantity');";

            $resultOrderItem = $objDB->query($queryInsertItem);

            unset($_SESSION['objCart']);
        }
    }

    public static function getPendingOrder() {
        $objDB = self::objDB();
        $querySelect = "SELECT count(*) 'count' FROM `order` WHERE orderStatus = 'pending' ";
//        echo $querySelect; die;
        $result = $objDB->query($querySelect);
        $data = $result->fetch_object();
        $pendingOrders = $data->count;
        return $pendingOrders;
    }

    public static function getAllOrders($userID = 0) {
        $objDB = self::objDB();
        $querySelect = "SELECT * FROM `order` ";
//        echo $querySelect;

        if($userID > 0) {
            $querySelect .= " WHERE userID = $userID ";
        }
        
        $result = $objDB->query($querySelect);

//        echo "<pre>";
//        print_r($result);
//        echo "<pre>";
//        die;
        $orders = array();
        while ($data = $result->fetch_object()) {
            $temp = array();
            $temp['orderID'] = $data->orderID;
            $temp['userID'] = $data->userID;
            $temp['orderDate'] = $data->orderDate;
            $temp['orderStatus'] = $data->orderStatus;
            $temp['addressID'] = $data->addressID;
            $orders[] = $temp;
        }
        return $orders;
    }

    public static function getOrderUserName($userID) {
        $objDB = self::objDB();
        $querySelect = "SELECT userName FROM users "
                . "WHERE userID = '$userID' ";
        $result = $objDB->query($querySelect);
        $data = $result->fetch_object();
        return $data->userName;
    }
    
    public static function getOrderUserAddress($addressID){
        $objDB = self::objDB();
        $querySelect = "SELECT streetAddress FROM addresses "
                . "WHERE addressID = '$addressID' ";
        $result = $objDB->query($querySelect);
        $data = $result->fetch_object();
        return $data->streetAddress;
    }

}
