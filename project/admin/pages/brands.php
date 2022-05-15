<?php
require_once '../../models/Brand.php';
require_once '../../models/Admin.php';
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

        <!-- *************************************************************** -->

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Brands</h1>
                        <p>
                            <?php
                            if (isset($_SESSION['msg'])) {
                                $msg = $_SESSION['msg'];
                                echo $msg;
                                unset($_SESSION['msg']);
                            }
                            if (isset($_SESSION['msgErr'])) {
                                $msgErr = $_SESSION['msgErr'];
                                echo $msgErr;
                                unset($_SESSION['msgErr']);
                            }
                            if (isset($_SESSION['errors'])) {
                                $errors = $_SESSION['errors'];
                                unset($_SESSION['errors']);
                            }
                            ?> 
                        </p>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3">
                        <form action="./process/processBrand.php" method="post" enctype="multipart/form-data">
                            <?php
                            if (isset($_GET['edit'])) {
                                $brandID = $_GET['edit'];
                                $objBrand = new Brand();
                                $objBrand->brandID = $brandID;
                                $objBrand->getBrand();
                                ?>
                                <div class="form-group">
                                    <label for="brandName">Name</label>
                                    <input type="text" name="brandName" value="<?php echo $objBrand->brandName; ?>" class="form-control" id="brandName" placeholder="Brand Name">
                                    <span>
                                        <?php
                                        if (isset($errors['brandName'])) {
                                            echo $errors['brandName'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="brandImage">Image</label>
                                    <img src="../../products/brands/<?php echo $objBrand->brandImage; ?>" alt="<?php echo $objBrand->brandName; ?>" width="120px" style="display: block;"/>
                                    <input type="file" name="brandImage" id="brandImage">
                                    <span>
                                        <?php
                                        if (isset($errors['brandImage'])) {
                                            echo $errors['brandImage'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <input type="hidden" name="brandID" value="<?php echo $objBrand->brandID; ?>" />
                                <button type="submit" name="updateBrand" class="btn btn-default">Update Brand</button>
                                <!--<button type="reset" class="btn btn-default">Reset</button>-->

                                <?php
                            } else {
                                ?>
                                <div class="form-group">
                                    <label for="brandName">Name</label>
                                    <input type="text" name="brandName" class="form-control" id="brandName" placeholder="Brand Name">
                                    <span>
                                        <?php
                                        if (isset($errors['brandName'])) {
                                            echo $errors['brandName'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="brandImage">Image</label>
                                    <input type="file" name="brandImage" id="brandImage">
                                    <span>
                                        <?php
                                        if (isset($errors['brandImage'])) {
                                            echo $errors['brandImage'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <button type="submit" name="addBrand" class="btn btn-default">Add Brand</button>
                                <!--<button type="reset" class="btn btn-default">Reset</button>-->
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                    <!-- /.col-lg-4 -->

                    <div class="col-lg-8 col-lg-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Available Brands
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class=" table-responsive">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="datatable-brands">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Delete</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            try {
                                                $brands = Brand::getbrands();
                                                foreach ($brands as $b) {
                                                    ?>
                                                    <tr class="odd gradeX text-center">
                                                        <td><?php echo ($b->brandID); ?></td>
                                                        <td><?php echo ($b->brandName); ?></td>
                                                        <td><img src="../../products/brands/<?php echo ($b->brandImage); ?>" alt="<?php echo ($b->brandName); ?>" class="img-thumbnail center-block " width="60px" height="auto"></td>
                                                        <td><a href="./process/processBrand.php?delete=<?php echo $b->brandID; ?>">Delete</a></td>
                                                        <td><a href="./brands.php?edit=<?php echo $b->brandID; ?>" >Edit</a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            } catch (Exception $ex) {
                                                echo ($ex->getMessage());
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->

                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-8 -->
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

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function () {
            $('#datatable-brands').DataTable({
                responsive: true
            });
        });
    </script>

</body>

</html>
