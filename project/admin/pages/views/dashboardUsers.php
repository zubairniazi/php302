
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
?>

<div class="panel panel-default">
    <div class="panel-heading">
        Dashboard User Details
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <table width="100%" class="table table-striped table-bordered table-hover" id="datatable-products">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <!-- th>Edit</th -->
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $adm = Admin::getAdmins();
                foreach ($adm as $a) {
                    echo "<tr class='odd gradeX text-center'>
                            <td>$a->adminID</td>
                            <td>$a->adminName</td>
                            <td>$a->adminEmail</td>    
                            <td>$a->adminRole</td>
                            <!-- td><a href='users.php?source=edit&adminID=$a->adminID'>Edit</a></td -->
                            <td><a href='process/processAdmin.php?delete=$a->adminID'>delete</a></td>
                        </tr>";
                }
                ?>

            </tbody>
        </table>
        <!--/.table-responsive -->

    </div>
    <!--/.panel-body -->
</div>
<!--/.panel -->