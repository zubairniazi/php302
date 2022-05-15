<?php

require_once 'DBConnection.php';

class Brand extends DBConnection {

    private $brandID;
    private $brandName;
    private $brandImage;

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

    private function setBrandID($brandID) {

        if (!is_numeric($brandID) && $brandID <= 0) {
            throw new Exception("Invalid/Missing brandID");
        }

        $this->brandID = $brandID;
    }

    private function getBrandID() {
        return $this->brandID;
    }

    private function setBrandName($brandName) {
        $reg = "/[A-Za-z]/";

        if (!preg_match($reg, $brandName)) {
            throw new Exception("Invalid/Missing brandName");
        }

        $this->brandName = $brandName;
    }

    private function getBrandName() {
        return $this->brandName;
    }

    private function setBrandImage($brandImage) {
        if ($brandImage['error'] == 4) {
            throw new Exception("File Missing!");
        }
        $imageData = getimagesize($brandImage['tmp_name']);
        if (!$imageData) {
            throw new Exception("Invalid image format");
        }
        if ($brandImage['size'] > 1000000) {
            throw new Exception("Max file size allowed is 1MB");
        }
        if ($brandImage['type'] != 'image/jpeg') {
            throw new Exception("Only jpeg allowed");
        }
        if ($brandImage['type'] != $imageData['mime']) {
            throw new Exception("Corrupt Image");
        }
        if (is_null($this->brandName)) {
            throw new Exception("Failed to generate file name");
        }
        $this->brandImage = "$this->brandName.jpg";
    }

    private function getBrandImage() {
        return $this->brandImage;
    }

    public function uploadBrandImage($sourceFile) {
        $strPath = $_SERVER['DOCUMENT_ROOT'] . "/php302/project/products/brands/$this->brandImage";

        if (!is_dir($_SERVER['DOCUMENT_ROOT'] . "/php302/project/products/brands")) {
            if (!mkdir($_SERVER['DOCUMENT_ROOT'] . "/php302/project/products/brands")) {
                throw new Exception("Failed to creater folder" . $_SERVER['DOCUMENT_ROOT'] . "/php302/project/products/brands");
            }
        }

        $result = @move_uploaded_file($sourceFile, $strPath);

        if (!$result) {
            throw new Exception("Failed to upload file");
        }
    }

    public function addBrand() {
        $objDB = $this->objDB();

        $queryInsert = "INSERT INTO `brands` "
                . "(`brandID`, `brandName`, `brandImage`) "
                . "VALUES "
                . "(NULL, '$this->brandName', '$this->brandImage') ";

        $result = $objDB->query($queryInsert);

        if ($objDB->errno) {
            throw new Exception("Failed to insert brand - $objDB->error - $objDB->errno");
        }

        $this->brandID = $objDB->insert_id;
    }

    public function getBrand() {
        $objDB = $this->objDB();

        $querySelect = "SELECT brandName, brandImage FROM brands "
                . "WHERE brandID = '$this->brandID' ";

        $result = $objDB->query($querySelect);

        $data = $result->fetch_object();

        $this->brandName = $data->brandName;
        $this->brandImage = $data->brandImage;
    }

    public static function getBrands() {
        $objDB = self::objDB();

        $querySelect = "SELECT * FROM brands ";

//        if ($productID > 0) {
//            $querySelect .= " join products on "
//                    . "brands.brandID = products.brandID "
//                    . "  ";
//        }
//        echo $querySelect; die;

        $result = $objDB->query($querySelect);

        if ($objDB->errno) {
            throw new Exception("Failed to get brands - $objDB->error - $objDB->errno");
        }
        if (!$result->num_rows) {
            throw new Exception("Brand(s) not Found");
        }

        $brands = array();

        while ($data = $result->fetch_object()) {
            $temp = new Brand();
            $temp->brandID = $data->brandID;
            $temp->brandName = $data->brandName;
            $temp->brandImage = $data->brandImage;
            $brands[] = $temp;
        }
        return $brands;
    }

    public function deleteBrand() {
        $objDB = $this->objDB();

        $queryDelete = "DELETE FROM brands "
                . "WHERE brandID = '$this->brandID' ";

        $result = $objDB->query($queryDelete);

        if ($objDB->errno) {
            throw new Exception("Failed to delete brand");
        }

        if (!$objDB->affected_rows) {
            throw new Exception("No record founded");
        }
    }

    public function updateBrand() {
        $objDB = $this->objDB();

        $queryUpdate = "UPDATE brands "
                . "SET brandName='$this->brandName', brandImage='$this->brandImage' "
                . "WHERE brandID = '$this->brandID' ";

        $result = $objDB->query($queryUpdate);

        if ($objDB->errno) {
            throw new Exception("Failed to update brand - $objDB->errno - $objDB->error");
        }
        if (!$objDB->affected_rows) {
            throw new Exception("Failed to update brand - $objDB->errno - $objDB->error");
        }
    }

    public static function getBrandCount() {
        $objDB = self::objDB();
        $querySelect = "SELECT count(*) 'count' FROM brands ";

        $result = $objDB->query($querySelect);
        $data = $result->fetch_object();
        $totalBrands = $data->count;
        return $totalBrands;
    }

}
