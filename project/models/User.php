<?php

require_once 'DBConnection.php';

class User extends DBConnection {

    private $userID;
    private $firstName;
    private $middleName;
    private $lastName;
    private $email;
    private $userName;
    private $password;
    private $contactNumber;
    private $gender;
    private $interests;
    private $dateOfBirth;
    private $streetAddress;
    private $city;
    private $state;
    private $country;
    private $profileImage;
    private $isActive;
    private $loginStatus;
    private $signupDate;

    public function __construct() {
        $this->interests = array();
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

    private function setUserID($userID) {

        if (!is_numeric($userID) || $userID <= 0) {
            throw new Exception("Invalid/Missing userID");
        }
        $this->userID = $userID;
    }

    private function getUserID() {
        return $this->userID;
    }

    private function setFirstName($firstName) {
        $reg = "/^[a-z]+$/i";

        if (!preg_match($reg, $firstName)) {
            throw new Exception("Invalid/Missing First Name");
        }

        $this->firstName = $firstName;
    }

    private function getFirstName() {
        return $this->firstName;
    }

    private function setMiddleName($middleName) {

        if (!empty($middleName)) {
            $reg = "/^[a-z]+/i";

            if (!preg_match($reg, $middleName)) {
                throw new Exception("Invalid Middle Name");
            }
            $this->middleName = $middleName;
        }
    }

    private function getMiddleName() {
        return $this->middleName;
    }

    private function setLastName($lastName) {
        $reg = "/^[a-z]+/i";

        if (!preg_match($reg, $lastName)) {
            throw new Exception("Invalid/Missing Last Name");
        }

        $this->lastName = $lastName;
    }

    private function getLastName() {
        return $this->lastName;
    }

    private function getFullName() {
        $fullName = "guest";

        if (!is_null($this->firstName) && !is_null($this->lastName)) {
            $fullName = "$this->firstName $this->middleName $this->lastName";
        }
        return $fullName;
    }

    private function setEmail($email) {
        $reg = "/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zAZ]\.)+[a-zA-Z]{2,4})$/";

        if (!preg_match($reg, $email)) {
            throw new Exception("Invalid/Missing Email");
        }

        $this->email = $email;
    }

    private function getEmail() {
        return $this->email;
    }

    private function setUserName($userName) {
        $reg = "/^[a-z][a-z0-9]{5,19}$/i";

        if (!preg_match($reg, $userName)) {
            throw new Exception("Invaid/Missing User Name");
        }

        $this->userName = $userName;
    }

    private function getUserName() {
        return $this->userName;
    }

    private function setPassword($password) {
        $reg = "/^[a-z][a-z0-9]{5,15}$/i";

        if (!preg_match($reg, $password)) {
            throw new Exception("Invalid/Short Password");
        }

        
        $this->password = sha1($password);
    }

    private function getPassword() {
        return $this->password;
    }

    private function setContactNumber($contactNumber) {
//        $reg = "/^\d{1,4}\-\d{3}\-\d{7}$/";
        $reg = "/^[0-9]+/";

        if (!preg_match($reg, $contactNumber)) {
            throw new Exception("Invalid/Missing Number");
        }

        $this->contactNumber = $contactNumber;
    }

    private function getContactNumber() {
        return $this->contactNumber;
    }

    private function setGender($gender) {
        $genders = array("Male", "Female");

        
        if (!in_array($gender, $genders)) {
            throw new Exception("Missing Gender");
        }
        $this->gender = $gender;
    }

    private function getGender() {
        return $this->gender;
    }

    private function setInterests($interests) {
        
        if (!is_array($interests)) {
            throw new Exception("Missing Interest(s) option");
        }

        if (count($interests) == 0) {
            throw new Exception("Missing Interest");
        }

        $this->interests = $interests;
    }

    private function getInterests() {
        return $this->interests;
    }

    private function setDateOfBirth($dateOfBirth) {
        if (empty($dateOfBirth)) {
            throw new Exception("Missing Date of Birth");
        }

        $reg = "/^\d{2}\-\d{2}\-\d{4}$/";
        if (!preg_match($reg, $dateOfBirth)) {
            throw new Exception("Invalid Date Format");
        }

        
        $parts = explode("-", $dateOfBirth);
        
        list($day, $month, $year) = $parts;

        
        if (!checkdate($month, $day, $year)) {
            throw new Exception("Invalid Date of Birth");
        }

        
        $this->dateOfBirth = mktime(0, 0, 0, $day, $month, $year);
    }

    private function getDateOfBirth() {
        if (is_null($this->dateOfBirth)) {
            return NULL;
        }
        
        $dateOfBirth = date("d-m-Y", $this->dateOfBirth);
        return $dateOfBirth;
    }

    private function getDay() {
        if (is_null($dateOfBirth)) {
            return NULL;
        }

        $dateOfBirth = date("d", $this->dateOfBirth);
        return $dateOfBirth;
    }

    private function getMonth() {
        if (is_null($dateOfBirth)) {
            return NULL;
        }

        $dateOfBirth = date("m", $this->dateOfBirth);
        return $dateOfBirth;
    }

    private function getYear() {
        if (is_null($dateOfBirth)) {
            return NULL;
        }

        $dateOfBirth = date("Y", $this->dateOfBirth);
        return $dateOfBirth;
    }

    private function setStreetAddress($streetAddress) {
        if (empty($streetAddress) || strlen($streetAddress) < 10) {
            throw new Exception("Missing/Too short street Address");
        }

        $this->streetAddress = $streetAddress;
    }

    private function getStreetAddress() {
        return $this->streetAddress;
    }

    private function setCity($city) {
        if (empty($city)) {
            throw new Exception("Missing City");
        }
        $this->city = $city;
    }

    private function getCity() {
        return $this->city;
    }

    private function setState($state) {
        if (empty($state)) {
            throw new Exception("Missing State");
        }
        $this->state = $state;
    }

    private function getState() {
        return $this->state;
    }

    private function setCountry($country) {
        $c_list = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        if (!in_array($country, $c_list)) {
            throw new Exception("Missing Country");
        }
        $this->country = $country;
    }

    private function getCountry() {
        return $this->country;
    }

    private function setProfileImage($profileImage) {
        if ($profileImage['error'] == 4) {
            throw new Exception("File Missing");
        }

        $imageData = getimagesize($profileImage['tmp_name']);

        echo "<pre>";
        print_r($profileImage);
        echo "</pre><br><br>";

        echo "<pre>";
        print_r($imageData);
        echo "</pre>";
        die;

        if (!$imageData) {
            throw new Exception("Invalid Image Format");
        }
        if ($profileImage['size'] > 500000) {
            throw new Exception("Max File size allowed is 500KB");
        }
        if ($profileImage['type'] != 'image/jpeg') {
            throw new Exception("Only jpeg allowed");
        }
        if ($profileImage['type'] != $imageData['mime']) {
            throw new Exception("Corrupt Image");
        }
        if (is_null($this->userName)) {
            throw new Exception("Failed to generate file name");
        }
        $this->profileImage = "$this->userName.jpg";
    }

    private function getProfileImage() {
        return $this->profileImage;
    }

    // readonly method
    private function getIsActive() {
        return $this->isActive;
    }

    public static function comparePasswords($password1, $password2) {
        if (empty($password2)) {
            throw new Exception("Missing password");
        }

        if ($password1 != $password2) {
            throw new Exception("Mismatched password");
        }
    }

    public function addUser($actCode) {
        $reg = "/^[a-z0-9]{32}$/i";
        if (!preg_match($reg, $actCode)) {
            throw new Exception("Invalid/Missing Active Code");
        }

        $objDB = $this->objDB();

        $query = "INSERT INTO `users` "
                . "(`userID`, `firstName`, `middleName`, `lastName`, `email`, "
                . "`userName`, `password`, `contactNumber`, `gender`, "
                . "`interests`, `dateOfBirth`, `streetAddress`, `city`, "
                . "`state`, `country`, `resetCode`, `profileImage`) "
                . "VALUES "
                . "(NULL, '$this->firstName', '$this->middleName', '$this->lastName', '$this->email', "
                . "'$this->userName', '$this->password', '$this->contactNumber', '$this->gender', "
                . "'" . serialize($this->interests) . "', '$this->dateOfBirth', '$this->streetAddress', "
                . "'$this->city', '$this->state', '$this->country', '$actCode', '$this->profileImage') ";

        $result = $objDB->query($query);

        if ($objDB->errno) {
            throw new Exception("Failed to insert User - $objDB->error - $objDB->errno");
        }

        $this->userID = $objDB->insert_id;
    }

    public function activate($actCode) {
        $reg = "/^[a-z0-9]{32}$/i";
        if (!preg_match($reg, $actCode)) {
            throw new Exception("Invalid/Missing Act Code");
        }
        $objDB = $this->objDB();

        $querySelect = "select userID, firstName, isActive, signupDate "
                . " from users "
                . " where userID = '$this->userID' "
                . " and resetCode = '$actCode'";

        $result = $objDB->query($querySelect);

        if ($objDB->errno) {
            throw new Exception("Failed to Get user - $objDB->error - $objDB->errno");
        }

        if (!$result->num_rows) {
            throw new Exception("Invalid Activation Data");
        }

        $data = $result->fetch_object();

        if ($data->isActive) {
            throw new Exception("Your account is already activated");
        }

        $expiryTime = strtotime($data->signupDate) + (60 * 60 * 24 * 3);
        $now = time();
        if ($now > $expiryTime) {
            $queryDelete = "delete from users "
                    . "where userID = '$this->userID'";
            $result = $objDB->query($queryDelete);

            if ($objDB->errno) {
                throw new Exception("Failed to execute delete user - $objDB->error - $objDB->errno");
            }
            if ($objDB->affected_rows == 0) {
                throw new Exception("Failed to delete user");
            }

            throw new Exception("Activation Link expired. Register again");
        }

        $queryUpdate = "update users set "
                . " isActive = 1 "
                . " where userID = '$this->userID'";

        $result = $objDB->query($queryUpdate);

        if ($objDB->errno) {
            throw new Exception("Failed to execute update user - $objDB->error - $objDB->errno");
        }
        if ($objDB->affected_rows == 0) {
            throw new Exception("Failed to update user");
        }
    }

    public function login($remember) {
        $objDB = $this->objDB();

        $querySelect = "SELECT userID, firstName, middleName, "
                . "lastName, gender, isActive, signupDate "
                . "FROM users "
                . "WHERE userName = '$this->userName' "
                . "AND password = '$this->password'";

        $result = $objDB->query($querySelect);

        if ($objDB->errno) {
            throw new Exception("Failed to Get Login User - $objDB->error - $objDB->errno");
        }

        if (!$result->num_rows) {
            throw new Exception("Login Failed");
        }

        $data = $result->fetch_object();

        if (!$data->isActive) {
            throw new Exception("Your account is pending activation");
        }

        $this->userID = $data->userID;
        $this->firstName = $data->firstName;
        $this->middleName = $data->middleName;
        $this->lastName = $data->lastName;
        $this->gender = $data->gender;
        $this->password = NULL;
        $this->loginStatus = TRUE;

        $strUser = serialize($this);
        $_SESSION['objUser'] = $strUser;

        if ($remember == 'TRUE') {
            $expire = time() + (60 * 60 * 24 * 3);
            setcookie("objUser", $strUser, $expire, "/");
        }
    }

    public function logout() {
        if (isset($_SESSION['objUser'])) {
            unset($_SESSION['objUser']);
        }
        if (isset($_COOKIE['objUser'])) {
            setcookie("objUser", "", 1, "/");
        }
    }

    public function getProfileData() {
        // your code goes here
        $objDB = $this->objDB();
        $querySelect = "SELECT * FROM users "
                . "WHERE userName = '$this->userName' AND userID = $this->userID ";

        $result = $objDB->query($querySelect);

        if ($objDB->errno) {
            throw new Exception("Failed to get User Details - $objDB->error - $objDB->errno ");
        }

        if (!$result) {
            throw new Exception("No User Data Found!");
        }

        $data = $result->fetch_object();

        $this->userID = $data->userID;
        $this->userName = $data->userName;
        $this->firstName = $data->firstName;
        $this->lastName = $data->lastName;
        $this->middleName = $data->middleName;
        $this->email = $data->email;
        $this->gender = $data->gender;
        $this->contactNumber = $data->contactNumber;
        $this->interests = unserialize($data->interests);
        $this->city = $data->city;
        $this->state = $data->state;
        $this->country = $data->country;
        $this->profileImage = $data->profileImage;
        $this->dateOfBirth = $data->dateOfBirth;
        $this->streetAddress = $data->streetAddress;
//        $this->password = NULL;

        $strUser = serialize($this);
        $_SESSION['objUser'] = $strUser;
    }

    public function updateProfile() {
        $objDB = $this->objDB();

        $queryUpdate = "UPDATE users "
                . "SET firstName = '$this->firstName', "
                . "lastName = '$this->lastName', "
                . "middleName = '$this->middleName', "
                . "contactNumber = '$this->contactNumber', "
                . "gender = '$this->gender', "
                . "interests = '" . serialize($this->interests) . "', "
                . "dateOfBirth = '$this->dateOfBirth', "
                . "streetAddress = '$this->streetAddress', "
                . "city = '$this->city', "
                . "state = '$this->state', "
                . "country = '$this->country', "
                . "profileImage = '$this->profileImage' "
                . "WHERE userID = $this->userID "
                . "and userName = '$this->userName' ";

        $result = $objDB->query($queryUpdate);
        if ($objDB->errno) {
            throw new Exception("Failed to update query - $objDB->error - $objDB->errno");
        }
        if (!$objDB->affected_rows) {
            throw new Exception("Failed to update user data");
        }

        $this->getProfileData();

//        $strUser = serialize($this);
//        $_SESSION['objUser'] = $strUser;
    }

    public static function checkPassword($currentPassword, $userID = 0, $userName = null) {
        if (!$currentPassword) {
            throw new Exception("Empty password!");
        }

        $objDB = self::objDB();

        $querySelect = "SELECT password FROM users "
                . "WHERE userID = $userID "
                . "and userName = '$userName' ";

//        echo $querySelect; die;

        $result = $objDB->query($querySelect);

        $data = $result->fetch_object();
        $currentPassword = sha1($currentPassword);
        if ($data->password != $currentPassword) {
            throw new Exception("Mismatched Password");
        }
    }

    public function changePassword() {
        $objDB = $this->objDB();

        $queryUpdate = "UPDATE users "
                . "SET password = '$this->password' "
                . "WHERE userID = $this->userID "
                . "and userName = '$this->userName' ";

        $result = $objDB->query($queryUpdate);

        if ($objDB->errno) {
            throw new Exception("Failed to update query - $objDB->error - $objDB->errno");
        }
        if (!$objDB->affected_rows) {
            throw new Exception("Password did not updated");
        }
    }

    public function resetCode($resetCode) {
        $objDB = $this->objDB();

        $queryUpdate = "UPDATE users "
                . "SET resetCode = '$resetCode' "
                . "WHERE email = '$this->email' ";

//        echo $queryUpdate;
//        die;

        $result = $objDB->query($queryUpdate);

        if ($objDB->errno) {
            throw new Exception("Failed to update query - $objDB->error - $objDB->errno");
        }
        if (!$objDB->affected_rows) {
            throw new Exception("Password did not updated");
        }
    }

    public function changeForgotPassword($resetCode) {
        $objDB = $this->objDB();

        $queryUpdate = "UPDATE users "
                . "SET password = '$this->password' "
                . "WHERE email = '$this->email' "
                . "AND resetCode = '$resetCode' ";

//        echo $queryUpdate;
//        die;

        $result = $objDB->query($queryUpdate);

        if ($objDB->errno) {
            throw new Exception("Failed to update query - $objDB->error - $objDB->errno");
        }
        if (!$objDB->affected_rows) {
            throw new Exception("Password did not updated");
        }
    }

    public function uploadProfileImage($sourceFile) {
        $strPath = $_SERVER['DOCUMENT_ROOT'] . "/php302/project/users/$this->userName/$this->profileImage";

        if (!is_dir($_SERVER['DOCUMENT_ROOT'] . "/php302/project/users")) {
            if (!mkdir($_SERVER['DOCUMENT_ROOT'] . "/php302/project/users")) {
                throw new Exception("Failed to creater folder" . $_SERVER['DOCUMENT_ROOT'] . "/php302/project/users");
            }
        }

        if (!is_dir($_SERVER['DOCUMENT_ROOT'] . "/php302/project/users/$this->userName")) {
            if (!mkdir($_SERVER['DOCUMENT_ROOT'] . "/php302/project/users/$this->userName")) {
                throw new Exception("Failed to create folder" . $_SERVER['DOCUMENT_ROOT'] . "/php302/project/users/$this->userName");
            }
        }

        // @move_uploaded_file - move file to the destination path, param(source, destination)
        $result = @move_uploaded_file($sourceFile, $strPath);

        if (!$result) {
            throw new Exception("Failed to upload file");
        }
    }

    //read-only properties
    private function getLogin() {
        return $this->loginStatus;
    }

    public function sendMail($subject, $mail) {
        require_once './class.phpmailer.php';

        $mail = new PHPMailer(TRUE);

        try {
            $mail->AddAddress($this->email, $this->fullName);
            $mail->SetFrom('noreply@domain.com', 'Admin');
            $mail->AddReplyTo('noreply@domain.com', 'Admin');
            $mail->Subject = $subject;
            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
            $mail->MsgHTML($mail);
            $mail->Send();
        } catch (phpmailerException $e) {
            throw $e;
        }
    }

    public function sendChangePasswordMail($subject, $mail) {
        require_once './class.phpmailer.php';

        $mail = new PHPMailer(TRUE);

        try {
            $mail->AddAddress($this->email, $this->fullName);
            $mail->SetFrom('noreply@domain.com', 'Admin');
            $mail->AddReplyTo('noreply@domain.com', 'Admin');
            $mail->Subject = $subject;
            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
            $mail->MsgHTML($mail);
            $mail->Send();
        } catch (phpmailerException $e) {
            throw $e;
        }
    }

    public static function getUsers() {
        $objDB = self::objDB();

        $querySelect = "SELECT * FROM users ";

        $result = $objDB->query($querySelect);

        if ($objDB->errno) {
            throw new Exception("Failed to select users - $objDB->error - $objDB->errno");
        }

        if (!$result->num_rows) {
            throw new Exception("No user found.");
        }

        $users = array();
        while ($data = $result->fetch_object()) {
            $temp = new User();
            $temp->userID = $data->userID;
            $temp->userName = $data->userName;
            $temp->firstName = $data->firstName;
            $temp->lastName = $data->lastName;
            $temp->email = $data->email;
            $temp->contactNumber = $data->contactNumber;
            $temp->gender = $data->gender;
            $temp->profileImage = $data->profileImage;
            $temp->isActive = $data->isActive;
            $users[] = $temp;
        }
        return $users;
    }

    public function deleteUser() {
        $objDB = $this->objDB();

        $queryDelete = "DELETE FROM users "
                . "WHERE userID = $this->userID ";

        $result = $objDB->query($queryDelete);
        if ($objDB->errno) {
            throw new Exception("Failed to delete user - $objDB->error - $objDB->errno");
        }

        if (!$objDB->affected_rows) {
            throw new Exception("No user deletev - $objDB->error - $objDB->errno");
        }
    }

    public static function getUserCount() {
        $objDB = self::objDB();
        $querySelect = "SELECT count(*) 'count' FROM users ";

        $result = $objDB->query($querySelect);
        $data = $result->fetch_object();
        $totalUsers = $data->count;
        return $totalUsers;
    }

}
