<?php
require_once '../models/User.php';
require_once '../models/Brand.php';
require_once '../models/Cart.php';
require_once '../models/Product.php';
require_once '../models/Category.php';
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
                
                <form action="<?php echo BASE_URL; ?>products/process/processCart.php" method="post" >
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="<?php echo BASE_URL; ?>index.php">Home</a> > Shopping Cart
                            <hr />
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                            if ($objCart->items) {
                                ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Shopping Cart
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                        <th>Remove</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                    <?php
                                                    foreach ($objCart->items as $item) {
                                                        echo "<tr class='text-center'>
                                                                    <td><a href='" . BASE_URL . "products/productDetails.php?productID=$item->itemID'><img src='" . BASE_URL . "products/catalog/$item->name/$item->name.jpg' alt='ProductA' width='100px' style='margin-right: 10px;' class='img-rounded'></a>$item->name</td>
                                                                    <td style='padding-top:50px;'> $ $item->unitPrice </td>
                                                                    <td style='padding-top:50px;'><input type='text' class='text-center' name='qtys[$item->itemID]' value='$item->quantity' style='width:30px;'></td>
                                                                    <td style='padding-top:50px;'>$ $item->totalAmount</td>
                                                                    <td style='padding-top:50px;'><a href='" . BASE_URL . "products/process/processCart.php?action=removeItem&itemID=$item->itemID'><span class='glyphicon glyphicon-remove-sign' style='font-size: 20px;'></span></a></td>
                                                            </tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Subtotal: $<?php echo $objCart->totalAmount; ?></th>
                                                        <th><a href="<?php echo BASE_URL ?>products/process/processCart.php?action=emptyCart">Empty Cart</a></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <p class="float-right"><label>Subtotal</label> $ <span><?php echo $objCart->totalAmount; ?> </span> USD </p>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="float-right">
                                                    <input type="hidden" name="action" value="updateCart" >
                                                    <input type="submit" value="Update Cart" class="btn btn-default btn-sm">
                                                    <a href="<?php echo BASE_URL; ?>products/checkOut.php" class="btn btn-danger btn-sm">Proceed to Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                                <?php
                            } else {
                                echo "Your cart is empty, please select product(s)";
                            }
                            ?>
                        </div>
                    </div>
                </form>
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