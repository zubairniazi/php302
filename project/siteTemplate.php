<?php
require_once './models/User.php';
require_once './models/Brand.php';
require_once './models/Cart.php';
require_once './models/Category.php';
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

                <h1>Place holder</h1>

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