<?php
require_once './models/User.php';
require_once './models/Brand.php';
require_once './models/Category.php';
require_once './models/Cart.php';
//require_once './models/Product.php';
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
                <div class="row" id="full-path">
                    <div class="col-xs-12">
                        <a href="<?php echo BASE_URL; ?>index.php">Home</a> / Contact Us
                        <hr />
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="blue">Contact Us</h4>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-sm-12">
                        <p>Donec feugiat ante ut enim pretium ultrices vel id velit. 
                            Donec blandit lectus id rhoncus tristique. Nunc sit amet faucibus risus. 
                            Nullam venenatis varius tellus eget rhoncus. 
                            Suspendisse commodo interdum tellus, et aliquet odio imperdiet
                            vitae. Aenean id cursus nunc.</p>
                    </div>
                </div>
                <!-- /.row -->
                <div id="contact-timing">
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <p>
                                    <span class="glyphicon glyphicon-play-circle" style="color: rgba(255, 102, 0, 0.78);"></span>
                                    Monday, Friday: 8.30am to 9.00pm PST
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <p>
                                    <span class="glyphicon glyphicon-play-circle" style="color: rgba(255, 102, 0, 0.78);"></span>
                                    Saturday: 10.00am to 7.00pm PST
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <p>
                                    <span class="glyphicon glyphicon-play-circle" style="color: rgba(255, 102, 0, 0.78);"></span>
                                    Sunday: 3.00pm to 7.00pm PST
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <p class="bold">Nunc sit amet faucibus risus. Nullam venenatis</p>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row" id="contact-form">
                    <div class="col-sm-12">
                        <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-5">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="">
                                    <spna>
                                        <?php
                                        if (isset($errors[''])) {
                                            echo $errors[''];
                                        }
                                        ?>
                                    </spna>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-5">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="">
                                    <spna>
                                        <?php
                                        if (isset($errors[''])) {
                                            echo $errors[''];
                                        }
                                        ?>
                                    </spna>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="contactNumber" class="col-sm-3 control-label">Contact Number</label>
                                <div class="col-sm-5">
                                    <input type="text" name="contactNumber" class="form-control" id="contactNumber" placeholder="Optional">
                                    <spna>
                                        <?php
                                        if (isset($errors[''])) {
                                            echo $errors[''];
                                        }
                                        ?>
                                    </spna>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message" class="col-sm-3 control-label">Message</label>
                                <div class="col-sm-7">
                                    <textarea name="message" class="form-control" rows="3"></textarea>
                                    <spna>
                                        <?php
                                        if (isset($errors['message'])) {
                                            echo $errors['message'];
                                        }
                                        ?>
                                    </spna>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" name="addProduct" class="btn btn-primary">Send</button>
                                    <button type="reset" name="reset" class="btn btn-default">Clear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

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