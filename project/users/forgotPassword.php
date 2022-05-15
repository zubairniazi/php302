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
                    Forgot Password
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
                    <form action="../process/processForgotPassword.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="cell cell-left">Email</div>
                            <div class="cell cell-right">
                                <input type="text" id="email" name="email" value="<?php echo ($objUser->email) ?>" placeholder="Email"  >            
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

                            <div class="cell cell-right">
                                <input type="submit" value="Submit Your Request">
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