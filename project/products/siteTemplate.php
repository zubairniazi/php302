<?php
require_once '../models/User.php';
require_once '../models/Brand.php';
require_once '../models/Product.php';
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

                <div class="row">
                    <div class="col-xs-12">
                        <hr />
                        <a href="#">Category</a> > <a href="#">Category2</a> > <a href="#">Category3</a> > Name Product
                        <hr />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 col-sm-12">
                                <img src="products/product01.jpg" alt="Product Name" width="100%" height="100%">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <button class="btn btn-link">more photos</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <span class="ion-chatbubble-working" id="product-comments"> </span>
                                <a href="#"> View comments (25)</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6" id="product-padding">
                        <div class="row">
                            <div class="col-md-10 col-sm-12">
                                <div class="row">
                                    <span class="name">Name Product</span>
                                    <span class="price product-price float-right">$2250</span>
                                </div>
                                <div class="row">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tempus, felis in 
                                        feugiat blandit, diam dui sagittis nulla, vitae fringilla dui mi interdum purus. Fusce
                                        venenatis nisl sit amet tortor ultrices commodo. Nulla non 
                                        odio porta, ornare orci non, hendrerit nisi. 
                                        Nulla sed tortor at dolor efficitur aliquam
                                    </p>
                                </div>
                                <div class="row">
                                    <label>Short Features:</label>
                                </div>
                                <div class="row" id="product-details">
                                    <div class="col-md-9 col-sm-12">
                                        <ul>
                                            <li>aliquam<span class="float-right">1122</span></li>
                                            <li>efficitur<span class="float-right">1122</span></li>
                                            <li>tortor<span class="float-right">1122</span></li>
                                            <li>sagittis<span class="float-right">1122</span></li>
                                            <li>consectetur<span class="float-right">1122</span></li>
                                            <li>Lorem ipsum<span class="float-right">1122</span></li>
                                            <li>sagittis<span class="float-right">1122</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <button class="btn btn-default btn-sm">Add to Cart</button>
                                    <span class="glyphicon glyphicon-shopping-cart" id="addCart"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="product-list">
                    <div class="row"> <span class="new heading">Similar Products</span> </div>
                    <div class="row">
                        <div class="article col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-12"> <img src="../images/products/product1.png" alt="product"> <a href="#" class="name">Name Product</a>
                            <br> <span class="price">$250</span>
                            <br>
                            <div>
                                <a href="#"><img src="../images/zoom.png" alt="zoom btn" width="52px" height="19px" class="zoom"></a>
                                <a href="#"><img src="../images/addToCart.png" alt="add to cart" width="71px" height="19px"></a>
                            </div>
                        </div>
                        <div class="article col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-12"> <img src="../images/products/product2.png" alt="product"> <a href="#" class="name">Name Product</a>
                            <br> <span class="price">$850</span>
                            <div>
                                <a href="#"><img src="../images/zoom.png" alt="zoom btn" class="zoom"></a>
                                <a href="#"><img src="../images/addToCart.png" alt="add to cart"></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="article  col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1"> <img src="../images/products/product3.png" alt="product"> <a href="#" class="name">Name Product</a>
                            <br> <span class="price">$400</span>
                            <div>
                                <a href="#"><img src="../images/zoom.png" alt="zoom btn" class="zoom"></a>
                                <a href="#"><img src="../images/addToCart.png" alt="add to cart"></a>
                            </div>
                        </div>
                        <div class="article col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1"> <img src="../images/products/product4.png" alt="product"> <a href="#" class="name">Name Product</a>
                            <br> <span class="price">$350</span>
                            <div>
                                <a href="#"><img src="../images/zoom.png" alt="zoom btn" class="zoom"></a>
                                <a href="#"><img src="../images/addToCart.png" alt="add to cart"></a>
                            </div>
                        </div>
                    </div>
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