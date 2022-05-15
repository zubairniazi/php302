<?php
require_once '../../models/Admin.php';
require_once './views/top.php';
?>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In
                        <?php
                        if (isset($_SESSION['msg'])) {
                            $msg = $_SESSION['msg'];
                            echo("<br>$msg");
                            unset($_SESSION['msg']);
                        }
                        if (isset($_SESSION['msgErr'])) {
                            $msgErr = $_SESSION['msgErr'];
                            echo("<br>$msgErr");
                            unset($_SESSION['msgErr']);
                        }

                        if (isset($_SESSION['errors'])) {
                            $errors = $_SESSION['errors'];
                            unset($_SESSION['errors']);
                        }
                        ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo(BASE_URL); ?>pages/process/processLogin.php" method="post" enctype="multipart/form-date">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="adminEmail" type="email" autofocus>
                                    <!--<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>-->
                                    <span>
                                        <?php
                                        if(isset($errors['adminEmail'])){
                                            echo $errors['adminEmail'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="adminPassword" type="password" value="">
                                    <!--<input class="form-control" placeholder="Password" name="password" type="password" value="">-->
                                    <span>
                                        <?php
                                        if(isset($errors['adminPassword'])){
                                            echo $errors['adminPassword'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button href="" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once './views/footer.php';
    ?>

</body>

</html>
