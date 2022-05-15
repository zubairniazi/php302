<?php
require_once './models/User.php';
require_once './models/Brand.php';
require_once './models/Category.php';
require_once './models/Product.php';
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
                <?php
                require_once './views/slider.php';
                ?>

                <div id="product-list">
                    <div class="row"> <span class="new heading">Products</span> </div>
                    <div class="row">
                        <?php
                        try {
                            $start = isset($_GET['start']) ? $_GET['start'] : 0;
                            $count = isset($_GET['count']) ? $_GET['count'] : ITEM_PER_PAGE;
                            $type = isset($_GET['type']) ? $_GET['type'] : "all";
                            $brandID = isset($_GET['brandID']) ? $_GET['brandID'] : 0;
                            $product = Product::getProducts($start, $count, $type, $brandID);

                            foreach ($product as $p) {
                                echo "
                                <div class='padding-bottom article col-md-6 col-sm-6 col-xs-12'> 
                                <img src='" . BASE_URL . "products/catalog/$p->productName/$p->productImage' alt='$p->productName' width='160px' height='auto'> 
                                <a href='" . BASE_URL . "products/productDetails.php?productID=$p->productID' class='name'>$p->productName</a>
                                <br> <span class='price'>$ $p->unitPrice</span>
                                <br>
                                <div>
                                    <a href='#'><img src='" . BASE_URL . "images/zoom.png' alt='zoom btn' width='52px' height='19px' class='zoom hidden-sm hidden-xs'></a>
                                    <form action='" . BASE_URL . "products/process/processCart.php' method='post'>
                                        <input type='hidden' name='action' value='addToCart' />
                                        <input type='hidden' name='productID' value='$p->productID' />
                                        <input type='image' src='" . BASE_URL . "images/addToCart.png' alt='add to cart' >
                                    </form>
                                </div>
                                </div>
                            ";
                            }

                            $pNums = Product::pageination(ITEM_PER_PAGE, $brandID);
                            echo "<div class='row'>"
                            . "<div class='col-xs-offset-2'>";

                            foreach ($pNums as $pNo => $start) {
                                echo "<a href='" . BASE_URL . "products/products.php?start=$start&type=$type&brandID=$brandID'>$pNo</a> - ";
                            }
                            echo "</div>"
                            . "</div>";
                        } catch (Exception $ex) {
                            echo ($ex->getMessage());
                        }
                        ?>

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