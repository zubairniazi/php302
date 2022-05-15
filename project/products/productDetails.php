<?php
require_once '../models/User.php';
require_once '../models/Brand.php';
require_once '../models/Category.php';
require_once '../models/Cart.php';
require_once '../models/Product.php';
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
                <?php
                try {
                    $productID = isset($_GET['productID']) ? $_GET['productID'] : 0;
                    $objP = new Product();
                    $objP->productID = $productID;
                    $objP->getProduct();
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            echo "<a href='" . BASE_URL . "index.php'>Home</a> / 
                            <a href='" . BASE_URL . "products/products.php?brandID=$objP->brandID'>";

                            try {
                                $objB = new Brand();
                                $objB->brandID = $objP->brandID;
                                $objB->getBrand();
                                echo "$objB->brandName";
                            } catch (Exception $ex) {
                                echo $ex->getMessage();
                            }

                            echo "</a> / 
                            <a href='" . BASE_URL . "products/products.php?catID=$objP->categoryID'>";
                            try {
                                $objC = new Category();
                                $objC->categoryID = $objP->categoryID;
                                $objC->getCategory();
                                echo "$objC->categoryName";
                            } catch (Exception $ex) {
                                echo $ex->getMessage();
                            }
                            echo "</a> / 
                            $objP->productName
                            <hr />";
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-md-11 col-md-offset-1 col-sm-12">
                                    <img src="catalog/<?php echo $objP->productName; ?>/<?php echo $objP->productImage; ?>" alt="<?php echo $objP->productName; ?>" width="250px" height="auto">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <a href="#" class="btn btn-link">more photos</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <span class="glyphicon glyphicon-comment" id="product-comments"> </span>
                                    <a href="#"> View comments (25)</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6" id="product-padding">
                            <div class="row">
                                <div class="col-md-10 col-sm-12">
                                    <div class="row">
                                        <span class="name"><?php echo $objP->productName; ?></span>
                                        <span class="price product-price float-right"><?php echo "$ " . $objP->unitPrice; ?></span>
                                    </div>
                                    <div class="row">
                                        <p>
                                            <?php echo $objP->description; ?>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <label>Short Features:</label>
                                    </div>
                                    <div class="row" id="product-details">
                                        <div class="col-md-9 col-sm-12">
                                            <ul>
                                                <?php
                                                $productFeatures = $objP->productFeatures;
                                                foreach ($productFeatures as $key => $value) {
                                                    echo "<li>$key<span class='float-right'>$value</span></li>";
                                                }
                                                ?>
    <!--                                                <li>efficitur<span class="float-right">1122</span></li>
                                                <li>Lorem ipsum<span class="float-right">1122</span></li>
                                                -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <form action="<?php BASE_URL; ?>process/processCart.php" method="post">
                                            <input type='hidden' name='action' value='addToCart' />
                                            <input type="hidden" name='productID' value='<?php echo $objP->productID; ?>' />
                                            <input type="submit" value="Add to Cart" class="btn btn-default btn-sm" />
                                            <span class="glyphicon glyphicon-shopping-cart" id="addCart"></span>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="product-list">
                        <div class="row"> <span class="new heading">Similar Products</span> </div>
                        <div class="row">
                            <?php
//                            $start = isset($_GET['start']) ? $_GET['start'] : 0;
//                            $count = isset($_GET['count']) ? $_GET['count'] : ITEM_PER_PAGE;
//                            $type = isset($_GET['type']) ? $_GET['type'] : "all";
                            $brandID = $objP->brandID;
//                            echo $brandID; die;
                            $product = Product::getProducts(0, 4, "top", $brandID);

                            foreach ($product as $p) {
                                echo "
                                <div class='padding-bottom article col-md-6 col-sm-6 col-xs-12'> 
                                <img src='" . BASE_URL . "products/catalog/$p->productName/$p->productImage' alt='$p->productName' width='140px'> 
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
                            ?>
                        </div>
                    </div>
                    <?php
                } catch (Exception $ex) {
                    echo($ex->getMessage());
                }
                ?>
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