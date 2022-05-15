<?php
require_once '../../models/Admin.php';
require_once '../../models/Order.php';
require_once './views/top.php';
?>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
        require_once './views/header.php';
        ?>

        <!-- *************************************************************** -->

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Orders</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Order's Details
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="datatable-products">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order Placer</th>
                                            <th>Order Date</th>
                                            <th>Order Status</th>
                                            <th>User Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        try {
                                            $orders = Order::getAllOrders();
                                            foreach ($orders as $o) {
                                                echo "<tr class='odd gradeX'>
                                                        <td>{$o['orderID']}</td>
                                                        <td>";
                                                try {
                                                    $userID = $o['userID'];
                                                    $orderUser = Order::getOrderUserName($userID);
                                                    echo "<a href='users.php'>$orderUser</a>";
                                                } catch (Exception $ex) {
                                                    echo $ex->getMessage();
                                                }

                                                echo "<td>{$o['orderDate']}</td>"
                                                . "<td class='text-center'>";
                                                
                                                if($o['orderStatus'] == 'pending') {
                                                    echo "<a href='#' title='Order is Pending' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-send'></span></a>";
                                                } else {
                                                    echo "<a href='#' title='Order Successfully delivered' class='btn btn-sm btn-success'><span class='glyphicon glyphicon-check'></span></a>";
                                                }
                                                
                                                echo "</td>"
                                                . "<td>";
                                                try {
                                                    $addressID = $o['addressID'];
                                                    $address = Order::getOrderUserAddress($addressID);
                                                    echo $address;
                                                } catch (Exception $ex) {
                                                    
                                                }
                                                echo "</td>"
                                                . "<td class='text-center'><a href='#'><span class='glyphicon glyphicon-edit'></span></a> |
                                                       <a href='#'><span class='glyphicon glyphicon-remove'></span></a></td>";
                                            }
                                        } catch (Exception $ex) {
                                            echo $ex->getMessage();
                                        }
                                        ?>

                                    </tbody>
                                </table>
                                <!--/.table-responsive -->

                            </div>
                            <!--/.panel-body -->
                        </div>
                        <!--/.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

        <!-- *************************************************************** -->

    </div>
    <!-- /#wrapper -->

    <?php
    require_once './views/footer.php';
    ?>

</body>

</html>
