<?php

require_once 'DBConnection.php';

class Product extends DBConnection {

    private $productID;
    private $productName;
    private $productFeatures;
    private $description;
    private $featured;
    private $unitPrice;
    private $quantity;
    private $viewCount;
    private $productImage;
    private $brandID;
    private $cateogryID;

    public function __construct() {
        $this->productFeatures = array();
    }

    public function __set($name, $value) {
        $method_name = "set$name";

        if (!method_exists($this, $method_name)) {
            throw new Exception("SET: $name Property not found");
        }

        $this->$method_name($value);
    }

    public function __get($name) {
        $method_name = "get$name";

        if (!method_exists($this, $method_name)) {
            throw new Exception("GET: $name Property not found");
        }

        return $this->$method_name();
    }

    private function setProductID($productID) {

        if (!is_numeric($productID) && $productID <= 0) {
            throw new Exception("Invalid/Missing productID");
        }
        $this->productID = $productID;
    }

    private function getProductID() {
        return $this->productID;
    }

    private function setProductName($productName) {
        $reg = "/[A-Za-z0-9]/";
        if (!preg_match($reg, $productName)) {
            throw new Exception("Invalid/Missing Product Name");
        }

        $this->productName = $productName;
    }

    private function getProductName() {
        return $this->productName;
    }

    private function setProductFeatures($productFeatures) {
        if (!is_array($productFeatures)) {
            throw new Exception("Missing Product Feature(s) option");
        }
        if (count($productFeatures) == 0) {
            throw new Exception("Missing Product Feature");
        }

        $this->productFeatures = $productFeatures;
    }

    private function getProductFeatures() {
        return $this->productFeatures;
    }

    private function setDescription($description) {
        $reg = "/[A-Za-z0-9]/";
        if (!preg_match($reg, $description)) {
            throw new Exception("Invalid/Missing Description");
        }
        $this->description = $description;
    }

    private function getDescription() {
        return $this->description;
    }

    private function setUnitPrice($unitPrice) {
        $reg = "/[0-9]/";
        if (!preg_match($reg, $unitPrice)) {
            throw new Exception("Invalid/Missing unitPrice");
        }
        $this->unitPrice = $unitPrice;
    }

    private function getUnitPrice() {
        return $this->unitPrice;
    }

    private function setFeatured($featured) {
        $reg = "/^[0-9]$/";
        if (!preg_match($reg, $featured)) {
            throw new Exception("Invalid or Missing featured");
        }
        $this->featured = $featured;
    }

    private function getFeatured() {
        return $this->featured;
    }

    private function setQuantity($quantity) {
        $reg = "/[0-9]/";
        if (!preg_match($reg, $quantity)) {
            throw new Exception("Invalid/Missing Quantity");
        }
        if (!is_numeric($quantity) && $quantity <= 0) {
            throw new Exception("Invalid Quantity");
        }
        $this->quantity = $quantity;
    }

    private function getQuantity() {
        return $this->quantity;
    }

    private function setBrandID($brandID) {

        if (!is_numeric($brandID)) {
            throw new Exception("Invalid/Missing brand id");
        }

        $this->brandID = $brandID;
    }

    private function getBrandID() {
        return $this->brandID;
    }

    private function setCategoryID($categoryID) {

        if (!is_numeric($categoryID)) {
            throw new Exception("Invalid/Missing category id");
        }

        $this->cateogryID = $categoryID;
    }

    private function getCategoryID() {
        return $this->cateogryID;
    }

    private function setProductImage($productImage) {
        if ($productImage['error'] == 4) {
            throw new Exception("File Missing");
        }
        $imageData = getimagesize($productImage['tmp_name']);
        if (!$imageData) {
            throw new Exception("Invalid Image Format");
        }
        if ($productImage['size'] > 5000000) {
            throw new Exception("Max File size allowed is 5M");
        }
        if ($productImage['type'] != 'image/jpeg') {
            throw new Exception("Only jpeg allowed");
        }
        if ($productImage['type'] != $imageData['mime']) {
            throw new Exception("Corrupt Image");
        }
        if (is_null($this->productName)) {
            throw new Exception("Failed to generate file name");
        }
        $this->productImage = "$this->productName.jpg";
    }

    private function getProductImage() {
        return $this->productImage;
    }

    public function addProduct() {
        $objDB = $this->objDB();

        $queryInsert = "INSERT INTO `products` "
                . "(`productID`, `productName`, `description`, `productFeatures`, "
                . "`unitPrice`, `quantity`, `viewCount`, `productImage`, "
                . "`featured`, `brandID`, `categoryID`) "
                . "VALUES "
                . "(NULL, '$this->productName', '$this->description', '" . serialize($this->productFeatures) . "', "
                . "'$this->unitPrice', '$this->quantity', '0', '$this->productImage', "
                . "'$this->featured', '$this->brandID', '$this->cateogryID' )";

//        echo $queryInsert; die;

        $result = $objDB->query($queryInsert);

        if ($objDB->errno) {
            throw new Exception("Failed to insert Product $objDB->error - $objDB->errno");
        }
    }

    public function uploadProductImage($sourceFile) {
        $strPath = $_SERVER['DOCUMENT_ROOT'] . "/php302/project/products/catalog/$this->productName/$this->productImage";

        if (!is_dir($_SERVER['DOCUMENT_ROOT'] . "/php302/project/products/catalog")) {
            if (!mkdir($_SERVER['DOCUMENT_ROOT'] . "/php302/project/products/catalog")) {
                throw new Exception("Failed to creater folder" . $_SERVER['DOCUMENT_ROOT'] . "/php302/project/products/catalog");
            }
        }

        if (!is_dir($_SERVER['DOCUMENT_ROOT'] . "/php302/project/products/catalog/$this->productName")) {
            if (!mkdir($_SERVER['DOCUMENT_ROOT'] . "/php302/project/products/catalog/$this->productName")) {
                throw new Exception("Failed to create folder" . $_SERVER['DOCUMENT_ROOT'] . "/php302/project/products/catalog/$this->productName");
            }
        }

        $result = @move_uploaded_file($sourceFile, $strPath);

        if (!$result) {
            throw new Exception("Failed to upload file");
        }
    }

    public static function getProducts($start = -1, $count = 0, $type = "all", $brandID = 0, $catID = 0, $config = array()) {
        $objDB = self::objDB();

        $querySelect = "SELECT * FROM products ";

        if ($brandID > 0) {
            $querySelect .= " where brandID='$brandID' ";
        }

        if ($catID > 0) {
            $querySelect .= " where CategoryId='$catID' ";
        }

        $types = array("all", "top", "new");

        if (!in_array($type, $types)) {
            $type = "all";
        }
        if ($type == "top") {
            $querySelect .= " order by viewCount desc ";
        } else if ($type == "new") {
            $querySelect .= " order by productID desc ";
        }
        if ($start > -1 && $count > 0) {
            $querySelect .= " limit $start, $count ";
        }

        $result = $objDB->query($querySelect);

        if ($objDB->errno) {
            throw new Exception("Failed to get products - $objDB->error - $objDB->errno");
        }
        if (!$result->num_rows) {
            throw new Exception("Product(s) not Found");
        }

        $products = array();

        while ($data = $result->fetch_object()) {
            $temp = new Product();
            $temp->productID = $data->productID;
            $temp->productName = $data->productName;
            $temp->productFeatures = unserialize($data->productFeatures);
            $temp->description = $data->description;
            $temp->featured = $data->featured;
            $temp->unitPrice = $data->unitPrice;
            $temp->quantity = $data->quantity;
            $temp->viewCount = $data->viewCount;
            $temp->productImage = $data->productImage;
            $temp->brandID = $data->brandID;
            $temp->categoryID = $data->categoryID;
            $products[] = $temp;
        }
        return $products;
    }

    public function getProduct() {
        $objDB = $this->objDB();

        $queryUpdate = "UPDATE products "
                . "SET viewCount = viewCount + 1 "
                . "WHERE productID = $this->productID ";

        $objDB->query($queryUpdate);

        $querySelect = "SELECT * FROM products "
                . "WHERE productID = '$this->productID' ";

        $result = $objDB->query($querySelect);

        if ($objDB->errno) {
            throw new Exception("Failed to get product - $objDB->error - $objDB->errno");
        }
        if ($result->num_rows > 1) {
            throw new Exception("Too many record found against $this->productID");
        }


        $data = $result->fetch_object();

        $this->productID = $data->productID;
        $this->productName = $data->productName;
        $this->description = $data->description;
        $this->featured = $data->featured;
        $this->productFeatures = unserialize($data->productFeatures);
        $this->quantity = $data->quantity;
        $this->unitPrice = $data->unitPrice;
        $this->viewCount = $data->viewCount;
        $this->productImage = $data->productImage;
        $this->brandID = $data->brandID;
        $this->categoryID = $data->categoryID;
    }

    public function updateProduct() {
        $objDB = $this->objDB();

        $queryUpdate = "UPDATE products "
                . "SET productName='$this->productName', description='$this->description', "
                . "productFeatures = '" . serialize($this->productFeatures) . "', unitPrice='$this->unitPrice', "
                . "productImage='$this->productImage', quantity = '$this->quantity', "
                . "featured='$this->featured', brandID='$this->brandID', categoryID='$this->cateogryID' "
                . "WHERE productID='$this->productID' ";

//        echo $queryUpdate; die;

        $result = $objDB->query($queryUpdate);

        if ($objDB->errno) {
            throw new Exception("Failed to update Product");
        }

        if (!$objDB->affected_rows) {
            throw new Exception("No record updated, please try again - $objDB->error - $objDB->errno");
        }
    }

    public function deleteProduct() {
        $objDB = $this->objDB();

        $queryDelete = "DELETE FROM products "
                . "WHERE productID = $this->productID ";

        $resutl = $objDB->query($queryDelete);

        if ($objDB->errno) {
            throw new Exception("Failed to delete product - $objDB->error - $objDB->errno");
        }

        if (!$objDB->affected_rows) {
            throw new Exception("Product Not deleted. - $objDB->error - $objDB->errno");
        }
    }

    public static function pageination($itemPerPage = 4, $brandID = 0) {
        $objDB = self::objDB();

        $querySelect = "select count(*) 'count'  from products ";

        if ($brandID > 0) {
            $querySelect .= " where brandID = '$brandID'";
        }

        $result = $objDB->query($querySelect);

        if ($objDB->errno) {
            throw new Exception("Failed to Get Products Count - $objDB->error - $objDB->errno");
        }

        if (!$result->num_rows) {
            throw new Exception("Product(s) not Found");
        }

        $data = $result->fetch_object();

        $totalItems = $data->count;
        $totalPages = ceil($totalItems / $itemPerPage);

        $pNums = array();

        for ($i = 1, $j = 0; $i <= $totalPages; $i++, $j += $itemPerPage) {
            $pNums[$i] = $j;
        }

//        echo("<pre>");
//        print_r($pNums);
//        echo("</pre>"); 
//        die;
        return $pNums;
    }

}
