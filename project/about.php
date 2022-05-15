<?php
require_once './models/User.php';
require_once './models/Brand.php';
require_once './models/Category.php';
require_once './models/Cart.php';
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
                        <a href="<?php echo BASE_URL; ?>index.php">Home</a> / About Us
                        <hr />
                    </div>
                </div>
                <!-- /.row -->
                <div id="about-us" class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12"> <span class="heading">About E Shop</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Nullam viverra sapien vel augue porta, et dapibus dui scelerisque. 
                            Donec feugiat ante ut enim pretium ultrices vel id velit. 
                            Donec blandit lectus id rhoncus tristique. Nunc sit amet faucibus risus. 
                            Nullam venenatis varius tellus eget rhoncus. 
                            Suspendisse commodo interdum tellus, et aliquet odio imperdiet vitae. 
                            Aenean id cursus nunc. Nulla aliquet urna in bibendum condimentum. 
                            Vestibulum ipsum orci, bibendum quis varius auctor, tristique eu velit. 
                            Nulla ex nulla, accumsan et sem pulvinar, facilisis accumsan tellus. 
                            Vestibulum ut turpis enim. 
                            Vivamus ultrices turpis eu feugiat pellentesque. </p>
                        <p>
                            Curabitur orci nibh, accumsan a dui sed, rhoncus dignissim neque. 
                            Praesent at aliquet dui. In lacinia ante non lacus pellentesque, eleifend vehicula turpis rhoncus. 
                            Maecenas eget congue quam, at finibus enim. Etiam lacinia quam in leo condimentum, ac ornare velit tempus. 
                            Etiam sagittis et sapien a pellentesque. Nam euismod ornare libero, quis dictum risus porta in. 
                            Duis sed enim nec lectus ullamcorper consectetur. 
                        </p>
                        <p>
                            Suspendisse non efficitur mauris. Sed accumsan vel sapien nec iaculis. 
                            Sed volutpat, nunc eget euismod porta, ipsum tortor ultricies dolor, nec ornare mi leo et magna. 
                            Proin eu ligula nisl. Aliquam facilisis massa vitae ante ultricies, eget ornare mi fermentum. 
                            Nulla volutpat urna vel ante tempus, vel gravida ligula efficitur. 
                            Etiam rutrum metus neque, vitae interdum dui fermentum sit amet. 
                            In sit amet est suscipit, efficitur ante vel, luctus leo. 
                            Maecenas tincidunt metus dolor, a ultricies neque interdum in. 
                            Mauris luctus porta finibus. In risus arcu, convallis non pulvinar sed, interdum eu mi. 
                            Duis nec suscipit leo. Cras vitae neque malesuada, hendrerit risus dictum, maximus magna. 
                        </p>
                        <p>Donec orci mauris, porta sit amet justo ac, scelerisque pellentesque lacus. 
                            Ut blandit dolor nisi, ultricies porttitor diam viverra vitae. 
                            Pellentesque ac vulputate metus. Sed et scelerisque risus, eget facilisis dolor. 
                            Phasellus egestas purus et massa tempor, iaculis fermentum mi sagittis. 
                            Nunc egestas, lacus suscipit imperdiet dapibus, dolor nisi fringilla dui, ac laoreet risus dolor in mauris. 
                            Integer malesuada ultricies velit, dapibus laoreet lorem mattis quis. 
                            Fusce urna lorem, vulputate quis tincidunt nec, ullamcorper blandit arcu. 
                            In volutpat sodales ante, auctor ornare mi. Nam semper est eget erat placerat eleifend. 
                            Curabitur pharetra, augue euismod fermentum vestibulum, nibh neque egestas turpis, nec venenatis 
                            ante est vitae nunc. </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Phasellus posuere et turpis tempor luctus. Fusce non tempor leo. 
                            Cras suscipit nisl at ex hendrerit convallis. Aenean et tempus orci.
                            Suspendisse rutrum, tortor vitae facilisis ullamcorper, est mauris ultricies ligula, 
                            malesuada rhoncus arcu odio quis tellus. Aliquam eget erat et tortor bibendum aliquet.
                            Morbi erat metus, pretium a vehicula commodo, hendrerit eu orci. Nam dictum leo sed velit posuere,
                            at lobortis enim vestibulum. Proin congue placerat egestas. Pellentesque eleifend 
                            dui sed imperdiet porttitor. Nunc aliquam metus nisi, sed laoreet leo interdum vel. </p>
                    </div>
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