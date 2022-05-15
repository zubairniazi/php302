<?php
require_once '../../models/Admin.php';
require_once '../../models/User.php';
//require_once '../../models/Product.php';
//require_once '../../models/Brand.php';
//require_once '../../models/Category.php';
require_once './views/top.php';
?>
<!-- DataTables CSS -->
<link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
        require_once './views/header.php';
        ?>
        <!--  ******************************************************************************  -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">


                    <?php
                    $source = isset($_GET['source']) ? $_GET['source'] : "";

                    switch ($source) {
                        case 'add':
                            require_once './views/addUser.php';
                            break;
                        case 'edit':
                            require_once './views/editUser.php';
                            break;
                        case 'dbuser':
                            require_once './views/dashboardUsers.php';
                            break;
                        default :
                            require_once './views/viewUsers.php';
                            break;
                    }
                    ?>


                </div>
                <!--/.col-lg-12 -->
            </div>
        </div>
        <!--/#page-wrapper -->
        <!--****************************************************************************** -->

    </div>
    <!--/#wrapper -->

    <?php
    require_once './views/footer.php';
    ?>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function () {
            $('#datatable-products').DataTable({
                responsive: true
            });
        });
    </script>

</body>

</html>
