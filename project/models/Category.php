<?php

require_once 'DBConnection.php';

class Category extends DBConnection {

    private $categoryID;
    private $categoryName;
    private $parentCategory;

    public function __construct() {
        
    }

    public function __set($name, $value) {
        $method_name = "set$name";

        if (!method_exists($this, $method_name)) {
            throw new Exception("SET: $name property not found");
        }

        $this->$method_name($value);
    }

    public function __get($name) {
        $method_name = "get$name";

        if (!method_exists($this, $method_name)) {
            throw new Exception("GET: $name property not found");
        }

        return $this->$method_name();
    }

    private function setCategoryID($categoryID) {

        if (!is_numeric($categoryID) && $categoryID <= 0) {
            throw new Exception("Invalid/Missing categoryID");
        }

        $this->categoryID = $categoryID;
    }

    private function getCategoryID() {
        return $this->categoryID;
    }

    private function setCategoryName($categoryName) {
        $reg = "/[A-Za-z]/";

        if (!preg_match($reg, $categoryName)) {
            throw new Exception("Invalid/Missing categoryName");
        }

        $this->categoryName = $categoryName;
    }

    private function getCategoryName() {
        return $this->categoryName;
    }

    private function setParentCategory($parentCategory) {

        if (!is_numeric($parentCategory)) {
            throw new Exception("Invalid/Missing parentCategory");
        }

        $this->parentCategory = $parentCategory;
    }

    private function getParentCategory() {
        return $this->parentCategory;
    }

    public function addCategory() {
        $objDB = $this->objDB();

        $queryInsert = "INSERT INTO `category` "
                . "(`CategoryId`, `CategoryName`, `ParentCategory`) "
                . "VALUES "
                . "(NULL, '$this->categoryName', '$this->parentCategory') ";

        $result = $objDB->query($queryInsert);

        if ($objDB->errno) {
            throw new Exception("Failed to insert category - $objDB->error - $objDB->errno");
        }

        $this->categoryID = $objDB->insert_id;
    }

    public function getCategory() {
        $objDB = $this->objDB();

        $querySelect = "SELECT CategoryName, ParentCategory FROM category "
                . "WHERE CategoryID = '$this->categoryID' ";
//        die($querySelect);

        $result = $objDB->query($querySelect);

        $data = $result->fetch_object();

        $this->categoryName = $data->CategoryName;
        $this->parentCategory = $data->ParentCategory;
    }

    public static function getCategories() {
        $objDB = self::objDB();

        $querySelect = "SELECT * FROM category ";

        $result = $objDB->query($querySelect);

        if ($objDB->errno) {
            throw new Exception("Failed to get category - $objDB->error - $objDB->errno");
        }
        if (!$result->num_rows) {
            throw new Exception("Category(s) not Found");
        }

//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
//        die;

        $cats = array();

        while ($data = $result->fetch_object()) {
            $temp = new Category();
            $temp->categoryID = $data->CategoryId;
            $temp->categoryName = $data->CategoryName;
            $temp->parentCategory = $data->ParentCategory;
            $cats[] = $temp;
        }
        return $cats;
    }

    public function deleteCategory() {
        $objDB = $this->objDB();

        $queryDelete = "DELETE FROM category "
                . "WHERE CategoryId = '$this->categoryID' ";

        $result = $objDB->query($queryDelete);

        if ($objDB->errno) {
            throw new Exception("Failed to delete category");
        }

        if (!$objDB->affected_rows) {
            throw new Exception("No record founded");
        }
    }

    public function updateCategory() {
        $objDB = $this->objDB();

        $queryUpdate = "UPDATE category "
                . "SET CategoryName = '$this->categoryName', "
                . "ParentCategory='$this->parentCategory' "
                . "WHERE CategoryID = '$this->categoryID' ";

        $result = $objDB->query($queryUpdate);

        if ($objDB->errno) {
            throw new Exception("Failed to update category");
        }
    }

    public static function getCatCount() {
        $objDB = self::objDB();
        $querySelect = "SELECT count(*) 'count' FROM category ";

        $result = $objDB->query($querySelect);
        $data = $result->fetch_object();
        $totalCats = $data->count;
        return $totalCats;
    }

}
