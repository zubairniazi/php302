<?php
require_once './models/User.php';
require_once './models/Brand.php';
require_once './models/Cart.php';
require_once './models/Category.php';
require_once './views/top.php';
?>

</head>

<body>
    <div id="page" class="container">
        <header>
            <?php
            require_once './views/header.php';
            ?>
        </header>
        <div id="content" class="container">
            <aside id="left" class="col-md-2 col-sm-3 hidden-xs">
                <?php
                require_once './views/middleLeft.php';
                ?>
            </aside>
            <section id="article-area" class="col-md-7 col-sm-9 col-xs-12">

                <!-- ************************************************ -->

                <div id="form-container">

                    <div id="heading-row">Login
                        <?php
                        if (isset($_SESSION['msgErr'])) {
                            $msgErr = $_SESSION['msgErr'];
                            echo("<br>$msgErr");
                            unset($_SESSION['msgErr']);
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

                    <form action="process/processLogin.php" method="post" enctype="multipart/form-data" id="signup-form">

                        <div class="row">
                            <div class="cell cell-left">User Name</div>
                            <div class="cell cell-right">
                                <input type="text" id="userName" name="userName" value="<?php echo ($objUser->userName); ?>" placeholder="User Name"  >
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
                            <div class="cell cell-left">Password</div>
                            <div class="cell cell-right">
                                <input type="password" id="password" name="password" placeholder="Password"  >
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
                            <div class="cell cell-left">
                                <input type="checkbox" id="remember" name="remember" value="remember">
                                Remember ME
                            </div>
                            <div class="cell cell-right">
                                <input type="submit" value="Login" >
                                <a href="signup.php" class="pull-right">Signup</a>
                            </div>
                            <div class="clear-box"></div>
                        </div>

                    </form>

                </div>


                <!-- ************************************************ -->

            </section>

            <aside id="right" class="col-md-3 col-md-offset-0 hidden-sm hidden-xs">
                <?php
                require_once './views/middleRight.php';
                ?>
            </aside>

        </div>

        <footer>
            <?php
            require_once './views/footer.php';
            ?>
        </footer>

    </div>
</body>

</html>