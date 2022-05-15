<?php

require_once 'Item.php';

class Cart extends Item {

    //put your code here
    private $items;

    public function __construct() {
        $this->items = array();
    }

    public function __get($name) {
        $method_name = "get$name";
        if (!method_exists($this, $method_name)) {
            throw new Exception("GET: Property $name not found");
        }
        return $this->$method_name();
    }

    private function getItems() {
        return $this->items;
    }

    private function getCount() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->quantity;
        }

        return $total;
    }

    private function getTotalAmount() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->totalAmount;
        }
        return $total;
    }

    public function addToCart($item) {
        if (!$item instanceof Item) {
            throw new Exception("Invalid Item object");
        }
        if (array_key_exists($item->itemID, $this->items)) {
            $this->items[$item->itemID]->quantity += $item->quantity;
        } else {
            $this->items[$item->itemID] = $item;
        }
//        echo "<pre>";
//        print_r($this->items);
//        echo "<pre>";
//        die;
    }

    public function removeItem($item) {
        if (!$item instanceof Item) {
            throw new Exception("Invalid Item Object");
        }

        if (array_key_exists($item->itemID, $this->items)) {
            unset($this->items[$item->itemID]);
        }
    }

    public function updateCart($qtys) {
        foreach ($this->items as $item) {
            if (is_numeric($qtys[$item->itemID])) {
                if ($qtys[$item->itemID] > 0) {
                    $item->quantity = $qtys[$item->itemID];
                } else if ($qtys[$item->itemID] == 0) {
                    $this->removeItem($item);
                }
            }
        }
    }

    public function emptyCart() {
        $this->items = array();
    }

}
