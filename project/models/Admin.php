<?php

require_once 'DBConnection.php';

class Admin extends DBConnection {

    private $adminID;
    private $adminName;
    private $adminEmail;
    private $adminPassword;
    private $adminRole;
    private $loginStatus;

    public function __construct() {
        
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

    private function setAdminID($adminID) {

        if (!is_numeric($adminID) || $adminID <= 0) {
            throw new Exception("Invalid/Missing AdminID");
        }

        $this->adminID = $adminID;
    }

    private function getAdminID() {
        return $this->adminID;
    }

    private function setAdminName($adminName) {
        $reg = "/^[a-z]+$/i"; 

        if (!preg_match($reg, $adminName)) {
            throw new Exception("Invalid/Missing Admin Name");
        }

        $this->adminName = $adminName;
    }

    private function getAdminName() {
        return $this->adminName;
    }

    private function setAdminEmail($adminEmail) {
        $reg = "/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zAZ]\.)+[a-zA-Z]{2,4})$/";

        if (!preg_match($reg, $adminEmail)) {
            throw new Exception("Invalid/Missing Email");
        }

        $this->adminEmail = $adminEmail;
    }

    private function getAdminEmail() {
        return $this->adminEmail;
    }

    private function setAdminPassword($adminPassword) {
        $reg = "/^[a-z][a-z0-9]{5,15}$/i";

        if (!preg_match($reg, $adminPassword)) {
            throw new Exception("Invalid/short Password");
        }

        $this->adminPassword = sha1($adminPassword);
    }

    private function getAdminPassword() {
        return $this->adminPassword;
    }

    private function setAdminRole($adminRole) {
        $types = array("admin", "standard");

        if (!in_array($adminRole, $types)) {
            throw new Exception("Invalid/Missing adminRole");
        }
        $this->adminRole = $adminRole;
    }

    private function getAdminRole() {
        return $this->adminRole;
    }

    public function addAdmin() {
        $objDB = $this->objDB();

        $queryInsert = "INSERT INTO admin "
                . "(`adminID`, `adminName`, `adminEmail`, `adminRole`, `adminPassword`) "
                . "VALUES "
                . "(NULL, '$this->adminName', '$this->adminEmail', '$this->adminRole', '$this->adminPassword') ";

        $result = $objDB->query($queryInsert);

        if ($objDB->errno) {
            throw new Exception("Failed to insert admin");
        }
        $this->adminID = $objDB->insert_id;
    }

    public function login($remember) {
        $objDB = $this->objDB();

        $querySelect = "SELECT adminID, adminName, adminEmail, adminRole "
                . "FROM admin "
                . "WHERE adminEmail = '$this->adminEmail' "
                . "AND adminPassword = '$this->adminPassword'";

//        echo $querySelect; die;

        $result = $objDB->query($querySelect);
        if ($objDB->errno) {
            throw new Exception("Failed to Get Login Admin - $objDB->error - $objDB->errno");
        }
        if (!$result->num_rows) {
            throw new Exception("Login Failed");
        }

        $data = $result->fetch_object();

//        if (!$data->isActive) {
//            throw new Exception("Your account is pending activation");
//        }

        $this->adminID = $data->adminID;
        $this->adminName = $data->adminName;
        $this->adminEmail = $data->adminEmail;
        $this->adminRole = $data->adminRole;
        $this->adminPassword = NULL;
        $this->loginStatus = TRUE;

        $strAdmin = serialize($this);
        $_SESSION['objAdmin'] = $strAdmin;

        if ($remember) {
            $expire = time() + (60 * 60 * 24 * 3);
            setcookie("objAdmin", $strAdmin, $expire, "/");
        }
    }

    private function getLogin() {
        return $this->loginStatus;
    }

    public function logout() {
        if (isset($_SESSION['objAdmin'])) {
            unset($_SESSION['objAdmin']);
        }
        if (isset($_COOKIE['objAdmin'])) {
            setcookie("objAdmin", "", 1, "/");
        }
    }

    public function getAdminData() {
        $objDB = $this->objDB();
    }

    public function getAdmin() {
        $objDB = $this->objDB();

        $querySelect = "SELECT * FROM admin "
                . "WHERE adminID = $this->adminID ";

        $result = $objDB->query($querySelect);

        if ($objDB->errno) {
            throw new Exception("Failed to select admin - $objDB->error - $objDB->errno");
        }
        if (!$result->num_rows) {
            throw new Exception("No admin data found!");
        }
        
        $data = $result->fetch_object();
        
        $this->adminID = $data->adminID;
        $this->adminName = $data->adminName;
        $this->adminEmail = $data->adminEmail;
        $this->adminRole = $data->adminRole;
    }

    public static function getAdmins() {
        $objDB = self::objDB();

        $querySelect = "SELECT * FROM admin ";

        $result = $objDB->query($querySelect);
        if ($objDB->errno) {
            throw new Exception("Failed to select admin - $objDB->error - $objDB->errno");
        }
        if (!$result->num_rows) {
            throw new Exception("No admin data found!");
        }

        $admins = array();
        while ($data = $result->fetch_object()) {
            $temp = new Admin();
            $temp->adminID = $data->adminID;
            $temp->adminName = $data->adminName;
            $temp->adminEmail = $data->adminEmail;
            $temp->adminRole = $data->adminRole;
            $admins[] = $temp;
        }
        return $admins;
    }

    public function deleteAdmin() {
        $objDB = $this->objDB();

        $queryDelete = "DELETE FROM admin "
                . "WHERE adminID = $this->adminID ";

        $result = $objDB->query($queryDelete);
        if ($objDB->errno) {
            throw new Exception("Failed to delete admin - $objDB->error - $objDB->errno");
        }
        if (!$objDB->affected_rows) {
            throw new Exception("No admin deleted");
        }
    }

}

?>