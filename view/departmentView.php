<?php
require '../model/department.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
    $department = new Department();
if (isset($_GET['id'])) {
$id=$_GET['id'];
$department=$department->getDepartment($id);
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title"> <b>Details Of Department</b></h3></div>
        <div class="panel-body">
            <div>
                <a href="departmentAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
                <a href="departmentList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
                <a href="departmentEdit.php?id=<?php echo $department->id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;

                <a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete');" href="departmentDelete.php?id=<?php echo $department->id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
            </div>&nbsp;&nbsp;
            <table id="table1" class="table-condensed table-responsive table-bordered grid">
                <tr>
                    <th>Name:</th><td><a href="departmentEdit.php?id=<?php echo $department->id; ?>"> <?php echo "$department->name"; ?></a></td>
                </tr>
                <tr>
                <tr>
                </tr>
                <tr>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php
require '../include/footer.php';
?>




