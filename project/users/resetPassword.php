<?php
require_once '../models/WebInterface.php';
require_once '../models/User.php';
require_once '../models/Brand.php';
require_once '../models/Category.php';
require_once '../models/Cart.php';
//require_once './models/Product.php';
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

                <div id="heading-row">
                    Change Password
                </div>
                <span>
                    <?php
                    if (isset($_SESSION['msg'])) {
                        $msg = $_SESSION['msg'];
                        echo $msg;
                        unset($_SESSION['msg']);
                    }
                    if (isset($_SESSION['errors'])) {
                        $errors = $_SESSION['errors'];
                        unset($_SESSION['errors']);
                    }
                    ?>
                </span>
                <div id="form-container">
                    <form action="../process/processPassword.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="cell cell-left">Current Password</div>
                            <div class="cell cell-right">
                                <input type="password" id="password" name="currentPassword" placeholder="Current Password"  >
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['currentPassword'])) {
                                        echo ($errors['currentPassword']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>
                        <div class="row">
                            <div class="cell cell-left">Password</div>
                            <div class="cell cell-right">
                                <input type="password" id="password" name="password" placeholder="New Password"  >
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['password'])) {
                                        echo ($errors['password']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>

                        <div class="row">
                            <div class="cell cell-left">Re-type Password</div>
                            <div class="cell cell-right">
                                <input type="password" id="password2" name="password2" placeholder="Re-type New Password" >
                                <span class="field-msg">
                                    <?php
                                    if (isset($errors['password2'])) {
                                        echo ($errors['password2']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="clear-box"></div>
                        </div>
                        <div class="row">
                            <div class="cell cell-left">
                                <div class="cell cell-right"><a href="<?php echo (BASE_URL); ?>users/resetPassword.php">Some Link</a></div>
                            </div>
                            <div class="cell cell-right">
                                <input type="submit" value="Submit" >
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