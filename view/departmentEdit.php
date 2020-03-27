<?php
require '../model/department.php';
require '../validation/departmentValidation.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
 if (isset($_POST['cancel'])) { redirect('departmentList.php');}
$res = new departmentValidation();
$department = new Department();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $department= $department->getDepartment($id);
}

if (isset($_POST['submit'])) {
    $department->id = $res->valInput($_POST['id']);
    $department->name = $res->valInput($_POST['name']);

    if ($res->validate($department)) {
        //insert
        $department->editDepartment($department);
    }
}
?>
<script type="text/javascript">

    $(document).ready(function() {

        $('#name').css('background-color', '#fbf3ba');

    });

</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="panel panel-info">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title">Edit A Department</h3>
        </div>
        <div class="panel-body">
            <?php
            if (empty($res->ERROR_MSG)) {
                
            } else {
                echo '<div class="alert alert-danger">';
                echo '<span>' . $res->ERROR_MSG . '</span>';
                echo '</div>';
            }
            ?>
            <form id="form1" method="post" action="departmentEdit.php" enctype="multipart/form-data">
                <table class="table-condensed">
                    <tr>
                        <td>
                            <a href="departmentList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><input name="name" type="text" placeholder="Name" class="form-control input-sm" id="name" value="<?php echo $department->name; ?>" /></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="id" value="<?php echo $department->department_id; ?>" />
                        </td>
                        <td><button type="submit" class="btn btn-info btn-sm" style="background-color: #428bca" name="submit"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save</button>
                            <button type="reset" class="btn btn-info btn-sm" style="background-color: #428bca" name="reset"><span class="glyphicon glyphicon-repeat"></span>&nbsp;Reset</button>
                            <button type="cancel" class="btn btn-info btn-sm" style="background-color: #428bca" name="cancel"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Close</button>
                        </td>

                    </tr>
                </table>

            </form>
        </div>
    </div>
</div>
<?php
require '../include/footer.php';
?>