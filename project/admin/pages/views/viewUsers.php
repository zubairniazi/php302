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
        Site User Details
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <table width="100%" class="table table-striped table-bordered table-hover" id="datatable-products">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Name</th>
                    <th>Contact</th>
                    <th>Gender</th>
                    <th>Image</th>
                    <th>Active Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
<?php
$users = User::getUsers();
foreach ($users as $u) {
    echo "<tr class='odd gradeX text-center'>
                            <td>$u->userID</td>
                            <td>$u->fullName</td>
                            <td>$u->email</td>    
                            <td>$u->userName</td>
                            <td>$u->contactNumber</td>
                            <td>$u->gender</td>
                            <td><img src='../../users/$u->userName/$u->profileImage' alt='$u->userName' width='120px' height='auto' ></td>";
    if ($u->isActive == 1) {
        echo "<td>Active</td>";
    } else {
        echo "<td>Inactive</td>";
    }
    echo "<td><a href='process/processUser.php?delete=$u->userID'>delete</a></td>
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