<?php
require_once '../models/User.php';
require_once '../models/Brand.php';
require_once '../models/Product.php';
require_once '../models/Category.php';
require_once '../models/Cart.php';
require_once '../models/Order.php';
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
                    <div class="col-md-12">
                        <a href="../index.php">Home</a> / My Orders
                        <hr />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Date</th>
                                        <th>Order Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php
                                    try {
                                        $userID = $objUser->userID;
//                                        echo "<td>$userID</td>";
//                                        die;
                                        $orders = Order::getAllOrders($userID);

                                        foreach ($orders as $o) {
                                            echo "<tr>
                                                    <td>{$o['orderID']}</td>
                                                    <td>{$o['orderDate']}</td>
                                                    <td class='text-center'>";

                                            if ($o['orderStatus'] == 'pending') {
                                                echo "<a href='#' title='Order is Pending' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-send'></span></a>";
                                            } else {
                                                echo "<a href='#' title='Order Successfully delivered' class='btn btn-sm btn-success'><span class='glyphicon glyphicon-check'></span></a>";
                                            }

                                            echo "</td>
                                                  <td><a href=''>Remove</a></td>
                                                 </tr>";
                                        }
                                    } catch (Exception $ex) {
                                        echo $ex->getMessage();
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
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