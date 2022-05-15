<?php
require_once '../models/WebInterface.php';
require_once '../models/User.php';
require_once '../models/Brand.php';
require_once '../models/Category.php';
require_once '../models/Cart.php';
//require_once './models/Product.php';
require_once '../views/top.php';
?>

<link href="../css/metallic.css" media="all" type="text/css" rel="stylesheet" >
<script src="../js/zebra_datepicker.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#dateOfBirth").Zebra_DatePicker({
            format: 'd-m-Y'
        });
    });
</script>
</head>

<body>
    <div id="page" class="container">
        <header>
            <?php
            require_once '../views/header.php';
            ?>
        </header>
        <div id="content" class="container">
            <aside id="left" class="col-md-2 col-sm-3 hidden-xs">
                <?php
                require_once '../views/middleLeft.php';
                ?>
            </aside>
            <section id="article-area" class="col-md-7 col-sm-9 col-xs-12">

                <!-- ************************************************ -->

                <div id="form-container">

                    <div id="heading-row">My Account - Edit Profile
                        <?php
                        $objUser->getProfileData();

//                        echo "<pre>";
//                        print_r($objUser);
//                        echo "</pre>";
//                        die;
                        if (isset($_SESSION['msg'])) {
                            $msg = $_SESSION['msg'];
                            echo("<br>$msg");
                            unset($_SESSION['msg']);
                        }

                        if (isset($_SESSION['errors'])) {
                            $errors = $_SESSION['errors'];
                            unset($_SESSION['errors']);
                        }
                        ?>
                    </div>

                    <form action="../process/processAccount.php" method="post" enctype="multipart/form-data" id="signup-form">

                        <div class="row">
                            <div class="cell cell-left">Profile Image </div>

                            <div class="cell cell-right">
                                <?php echo "<img src='../users/$objUser->userName/$objUser->profileImage' alt='$objUser->userName' width='200px' height='auto' >"; ?>
                                <input type="file" id="profileImage" name="profileImage" >
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['profileImage'])) {
                                        echo($errors['profileImage']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>

                        <div class="row">
                            <div class="cell cell-left">First Name</div>
                            <div class="cell cell-right">
                                <input type="text" id="firstName" name="firstName" value="<?php echo($objUser->firstName); ?>" placeholder="First Name"  >
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['firstName'])) {
                                        echo($errors['firstName']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>

                        <div class="row">
                            <div class="cell cell-left">Middle Name</div>
                            <div class="cell cell-right">
                                <input type="text" id="middleName" name="middleName" value="<?php echo($objUser->middleName); ?>" placeholder="Middle Name" >
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['middleName'])) {
                                        echo ($errors['middleName']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>

                        <div class="row">
                            <div class="cell cell-left">Last Name</div>
                            <div class="cell cell-right">
                                <input type="text" id="lastName" name="lastName" value="<?php echo($objUser->lastName); ?>" placeholder="Last Name"  >
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['lastName'])) {
                                        echo($errors['lastName']);
                                    }
                                    ?>

                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>

                        <div class="row">
                            <div class="cell cell-left">Email</div>
                            <div class="cell cell-right">
                                <input type="text" id="email" name="email" value="<?php echo ($objUser->email) ?>" placeholder="Email"  readonly>            
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['email'])) {
                                        echo ($errors['email']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>

                        <div class="row">
                            <div class="cell cell-left">User Name</div>
                            <div class="cell cell-right">
                                <input type="text" id="userName" name="userName" value="<?php echo ($objUser->userName) ?>" placeholder="User Name" readonly >
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['userName'])) {
                                        echo ($errors['userName']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>


                        <div class="row">
                            <div class="cell cell-left">Contact Number</div>
                            <div class="cell cell-right">
                                <input type="text" id="contactNumber" name="contactNumber" value="<?php echo ($objUser->contactNumber) ?>" maxlength="16"   placeholder="Contact Number">
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['contactNumber'])) {
                                        echo ($errors['contactNumber']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>

                        <div class="row">
                            <div class="cell cell-left">Gender: </div>
                            <div class="cell cell-right">
                                <?php
                                if ($objUser->gender == 'Male') {
                                    ?>
                                    <input type = "radio" name = "gender" value = "Male" id = "male" checked> Male
                                    <input type = "radio" name = "gender" value = "Female" id = "female"> Female
                                    <?php
                                } else if ($objUser->gender == 'Female') {
                                    ?>
                                    <input type="radio" name="gender" value="Male" id="male"> Male
                                    <input type="radio" name="gender" value="Female" id="female" checked> Female
                                    <?php
                                } else {
                                    ?>
                                    <input type="radio" name="gender" value="Male" id="male"> Male
                                    <input type="radio" name="gender" value="Female" id="female"> Female
                                    <?php
                                }
                                ?>
                                <span class = "field-msg">
                                    <?php
                                    if (isset($errors['gender'])) {
                                        echo ($errors['gender']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>	
                        </div>

                        <div class="row">
                            <div class="cell cell-left">Interest: </div>
                            <div class="cell cell-right">
                                <?php
                                $laptop = "";
                                $mobile = "";
                                $iphone = "";

                                if (in_array("Laptop", $objUser->interests)) {
                                    $laptop = "checked";
                                }
                                if (in_array("Mobile", $objUser->interests)) {
                                    $mobile = "checked";
                                }
                                if (in_array("IPhone", $objUser->interests)) {
                                    $iphone = "checked";
                                }
                                ?>


                                Laptop <input type="checkbox" id="laptop" name="interests[]" value="Laptop" <?php echo $laptop; ?>> -
                                Mobile <input type="checkbox" id="mobile" name="interests[]" value="Mobile" <?php echo $mobile; ?>> -
                                iPhone <input type="checkbox" id="iphone" name="interests[]" value="iPhone" <?php echo $iphone; ?>> 

                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['interests'])) {
                                        echo ($errors['interests']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>

                        <div class="row">
                            <div class="cell cell-left">Date Of Birth</div>
                            <div class="cell cell-right">
                                <input type="text" id="dateOfBirth" name="dateOfBirth" value="<?php echo($objUser->dateOfBirth); ?>" placeholder="dd-mm-YYYY">
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['dateOfBirth'])) {
                                        echo $errors['dateOfBirth'];
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>

                        <div class="row">
                            <div class="cell cell-left">Street Address</div>
                            <div class="cell cell-right">
                                <textarea id="streetAddress" name="streetAddress" class="street_address"   placeholder="Street Address"><?php echo ($objUser->streetAddress) ?></textarea>
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['streetAddress'])) {
                                        echo $errors['streetAddress'];
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>


                        <div class="row">
                            <div class="cell cell-left">City</div>
                            <div class="cell cell-right">
                                <input type="text" id="city" name="city" placeholder="City" value="<?php echo($objUser->city); ?>">
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['city'])) {
                                        echo $errors['city'];
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>	
                        </div>

                        <div class="row">
                            <div class="cell cell-left">State</div>
                            <div class="cell cell-right">
                                <input type="text" id="state" name="state"  placeholder="State" value="<?php echo($objUser->state); ?>">
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['state'])) {
                                        echo($errors['state']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>

                        <div class="row">
                            <div class="cell cell-left">Country</div>
                            <div class="cell cell-right">
                                <?php
                                WebInterface::loadCountries($objUser->country);
                                ?>
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['country'])) {
                                        echo($errors['country']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>

                        <div class="row">
                            <div class="cell cell-left">
                                <div class="cell cell-right"><a href="<?php echo (BASE_URL); ?>users/resetPassword.php">Reset Password</a></div>
                            </div>
                            <div class="cell cell-right">
                                <input type="submit" value="Update" >
                            </div>
                            <div class="clear-box"></div>
                        </div>

                    </form>

                </div>


                <!-- ************************************************ -->

            </section>

            <aside id="right" class="col-md-3 col-md-offset-0 hidden-sm col-xs-8 col-xs-offset-2">
                <?php
                require_once '../views/middleRight.php';
                ?>
            </aside>

        </div>

        <footer>
            <?php
            require_once '../views/footer.php';
            ?>
        </footer>

    </div>
</body>

</html>