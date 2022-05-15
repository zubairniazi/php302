<?php

require_once 'DBConnection.php';

class Item extends DBConnection {

    //put your code here
    private $itemID;
    private $quantity;

    public function __construct($itemID, $quantity = 1) {
        $this->setItemID($itemID);
        $this->setQuantity($quantity);
    }

    public function __set($name, $value) {
        $allowed = array("quantity");
        if (!in_array($name, $allowed)) {
            throw new Exception("Property $name is readonly");
        }

        $method_name = "set$name";
        if (!method_exists($this, $method_name)) {
            throw new Exception("SET: Property $name not found");
        }

        $this->$method_name($value);
    }

    public function __get($name) {
        $method_name = "get$name";
        if (!method_exists($this, $method_name)) {
            throw new Exception("GET: Property $name is not found");
        }
        return $this->$method_name();
    }

    private function setItemID($itemID) {
        if (!is_numeric($itemID) || $itemID <= 0) {
            throw new Exception("Invalid/Missing Item ID");
        }

        $this->itemID = $itemID;
    }

    private function getItemID() {
        return $this->itemID;
    }

    private function setQuantity($quantity) {
        if (!is_numeric($quantity) || $quantity <= 0) {
            throw new Exception("Invalid/Missing Quantity");
        }
        $this->quantity = $quantity;
    }

    private function getQuantity() {
        return $this->quantity;
    }

    private function getName() {
        $query = "SELECT productName FROM products "
                . "WHERE productID = '$this->itemID' ";

        $objDB = $this->objDB();
        $resut = $objDB->query($query);
        $data = $resut->fetch_object();
        return $data->productName;
    }

    private function getUnitPrice() {
        $query = "SELECT unitPrice FROM products "
                . "WHERE productID = '$this->itemID' ";

        $objDB = $this->objDB();
        $result = $objDB->query($query);
        $data = $result->fetch_object();
        return $data->unitPrice;
    }

    private function getTotalAmount() {
        $total = $this->unitPrice * $this->quantity;
        return $total;
    }

}
