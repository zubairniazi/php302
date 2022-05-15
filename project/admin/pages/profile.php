<?php
require_once '../../models/Admin.php';
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
                        <h1 class="page-header">Profile Data</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                My Account Details
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>#</th>
                                            <td><?php echo $objAdmin->adminID; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Name:</th>
                                            <td><?php echo $objAdmin->adminName; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td><?php echo $objAdmin->adminEmail; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Role</th>
                                            <td><?php echo $objAdmin->adminRole; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
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
