<?php
require_once '../models/WebInterface.php';
require_once '../models/User.php';
require_once '../models/Brand.php';
require_once '../models/Category.php';
require_once '../models/Cart.php';
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
                    $email = isset($_GET['email']) ? $_GET['email'] : "";
                    $resetCode = isset($_GET['resetCode']) ? $_GET['resetCode'] : NULL;

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
                    <form action="../process/processChangePassword.php" method="post" enctype="multipart/form-data">
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
                            <div class="cell cell-right">
                                <input type="hidden" name="email" value="<?php echo $email; ?>">
                                <input type="hidden" name="resetCode" value="<?php echo $resetCode; ?>">
                                <input type="submit" value="Change Password" >
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