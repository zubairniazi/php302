<?php
require_once '../models/WebInterface.php';
require_once '../models/User.php';
require_once '../models/Brand.php';
require_once '../models/Category.php';
require_once '../models/Cart.php';
//require_once '../models/Product.php';
require_once '../views/top.php';
?>

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
                <div class="row" id="full-path">
                    <div class="col-xs-12">
                        <a href="<?php echo BASE_URL; ?>index.php">Home</a> > Checkout
                        <hr />
                    </div>
                </div>
                <!-- /.row -->
                <div id="form-container">

                    <div id="heading-row">Place Order
                        <?php
                        if (isset($_SESSION['objContact'])) {
                            $objContact = unserialize($_SESSION['objContact']);
                        } else {
                            $objContact = new User();
                        }
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

                    <form action="process/processOrder.php" method="post" enctype="multipart/form-data" id="signup-form">

                        <div class="row">
                            <div class="cell cell-left">First Name</div>
                            <div class="cell cell-right">
                                <input type="text" id="firstName" name="firstName" value="<?php echo($objContact->firstName); ?>" placeholder="First Name"  >
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
                                <input type="text" id="middleName" name="middleName" value="<?php echo($objContact->middleName); ?>" placeholder="Middle Name" >
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
                                <input type="text" id="lastName" name="lastName" value="<?php echo($objContact->lastName); ?>" placeholder="Last Name"  >
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
                            <div class="cell cell-left">Contact Number</div>
                            <div class="cell cell-right">
                                <input type="text" id="contactNumber" name="contactNumber" value="<?php echo($objContact->contactNumber); ?>" maxlength="16"   placeholder="Contact Number">
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
                            <div class="cell cell-left">Street Address</div>
                            <div class="cell cell-right">
                                <textarea id="streetAddress" name="streetAddress" class="street_address" placeholder="Street Address"><?php echo($objContact->streetAddress); ?></textarea>
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
                                <input type="text" id="city" name="city" placeholder="City" value="<?php echo($objContact->city); ?>">
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
                                <input type="text" id="state" name="state"  placeholder="State" value="<?php echo($objContact->state); ?>">
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
                                WebInterface::loadCountries($objContact->country);
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
                            <div class="text-center">
                                <input type="hidden" name="userID" value="<?php echo $objUser->userID; ?>">
                                <input type="submit" value="Place order" >
                            </div>
                            <div class="clear-box"></div>
                        </div>

                    </form>

                </div>


                <!-- ************************************************ -->

            </section>

            <aside id="right" class="col-md-3 col-md-offset-0 hidden-sm hidden-xs">
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