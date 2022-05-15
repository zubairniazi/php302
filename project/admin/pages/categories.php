<?php
require_once '../../models/Category.php';
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
                        <h1 class="page-header"> Categories</h1>
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
                        <form action="process/processCategory.php" method="post" enctype="multipart/form-data">
                            <?php
                            if (isset($_GET['edit'])) {
                                $categoryID = $_GET['edit'];
                                $objCat = new Category();
                                $objCat->categoryID = $categoryID;
                                $objCat->getCategory();
                                ?>
                                <div class="form-group">
                                    <label for="categoryName">Name</label>
                                    <input type="text" name="categoryName" value="<?php echo $objCat->categoryName; ?>" class="form-control" id="categoryName" placeholder="Category Name">
                                    <span>
                                        <?php
                                        if (isset($errors['categoryName'])) {
                                            echo $errors['categoryName'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="parentCategory">Parent Category</label>
                                    <input type="input" name="parentCategory" value="<?php echo $objCat->parentCategory; ?>" class="form-control" id="parentCategory">
                                    <span>
                                        <?php
                                        if (isset($errors['parentCategory'])) {
                                            echo $errors['parentCategory'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <input type="hidden" name="categoryID" value="<?php echo $objCat->categoryID; ?>" />
                                <button type="submit" name="updateCategory" class="btn btn-default">Update Category</button>
                                <!--<button type="reset" class="btn btn-default">Reset</button>-->

                                <?php
                            } else {
                                ?>
                                <div class="form-group">
                                    <label for="categoryName">Name</label>
                                    <input type="text" name="categoryName" class="form-control" id="categoryName" placeholder="Category Name">
                                    <span>
                                        <?php
                                        if (isset($errors['categoryName'])) {
                                            echo $errors['categoryName'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="parentCategory">Parent ID</label>
                                    <input type="input" name="parentCategory" class="form-control" id="parentCategory" placeholder="Parent Id">
                                    <span>
                                        <?php
                                        if (isset($errors['parentCategory'])) {
                                            echo $errors['parentCategory'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <button type="submit" name="addCategory" class="btn btn-default">Add Category</button>
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
                                Available Categories
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class=" table-responsive">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="datatable-brands">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Parent Category</th>
                                                <th>Delete</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            try {
                                                $cat = Category::getCategories();
                                                foreach ($cat as $c) {
                                                    ?>
                                                    <tr class="odd gradeX text-center">
                                                        <td><?php echo ($c->categoryID); ?></td>
                                                        <td><?php echo ($c->categoryName); ?></td>
                                                        <td><?php echo ($c->parentCategory); ?></td>
                                                        <td><a href="./process/processCategory.php?delete=<?php echo $c->categoryID; ?>">Delete</a></td>
                                                        <td><a href="./categories.php?edit=<?php echo $c->categoryID; ?>" >Edit</a></td>
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
