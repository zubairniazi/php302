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
                        <h1 class="page-header">Message</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        <?php
                        if (isset($_SESSION['msg'])) {
                            $msg = $_SESSION['msg'];
                            echo "$msg";
                            unset($_SESSION['msg']);
                        }

                        if (isset($_SESSION['msgErr'])) {
                            $msg = $_SESSION['msgErr'];
                            echo($msg);
                            unset($_SESSION['msgErr']);
                        }
                        ?>
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
