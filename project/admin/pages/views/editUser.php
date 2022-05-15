<div class="row">
    <div class="col-lg-8">
        <h3>Update Dashboard User Details:</h3>
        <p>
            <?php
            if (isset($_GET['adminID'])) {
                $adminID = $_GET['adminID'];
                try {
                    $objAdminE = new Admin();
                    $objAdminE->adminID = $adminID;
                    $objAdminE->getAdmin();
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            }

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
        <form class="form-horizontal" action="process/processAdmin.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="adminName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="adminName" value="<?php echo $objAdminE->adminName; ?>" class="form-control" id="adminName" placeholder="User Name">
                    <span>
                        <?php
                        if (isset($errors['adminName'])) {
                            echo $errors['adminName'];
                        }
                        ?>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email </label>
                <div class="col-sm-10">
                    <input type="email" name="adminEmail" value="<?php echo $objAdminE->adminEmail; ?>" class="form-control" id="email" placeholder="write your email here" readonly>
                    <span>
                        <?php
                        if (isset($errors['adminEmail'])) {
                            echo $errors['adminEmail'];
                        }
                        ?>
                    </span>
                </div>
            </div>
<!--            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class=" col-sm-10">
                    <input type="password" class="form-control" id="password" name="adminPassword" placeholder="new or current" >
                    <span>
                        <?php
//                        if (isset($errors['adminPassword'])) {
//                            echo $errors['adminPassword'];
//                        }
                        ?>
                    </span>
                </div>
            </div>-->
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">User Role</label>
                <div class="col-sm-10 radio">
                    <?php
                    if ($objAdminE->adminRole == 'admin') {
                        echo "<label>
                                <input type='radio' name='adminRole' id='' value='admin' checked>Admin 
                            </label>
                            <label>
                                <input type='radio' name='adminRole' id='' value='standard' >Standard 
                            </label>";
                    } else {
                        echo "<label>
                            <input type='radio' name='adminRole' id='' value='admin'>Admin 
                            </label>
                            <label>
                                <input type='radio' name='adminRole' id='' value='standard' checked>Standard 
                            </label>";
                    }
                    ?>

                    <span>
                        <?php
                        if (isset($errors['adminRole'])) {
                            echo $errors['adminRole'];
                        }
                        ?>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="updateAdmin" class="btn btn-default">Update User</button>
                    <a href="#" class="btn btn-danger">Change Password</a>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.row -->