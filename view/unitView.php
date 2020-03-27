<?php
require '../model/unit.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
    $unit = new Unit();
if (isset($_GET['id'])) {
$id = $_GET['id'];
$unit = $unit->getUnit($id);
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="panel panel-default">
<div class="panel-heading" style="background-color: #428bca; color:#ffffff">
 <h3 class="panel-title"> <b>Details Of A Unit</b></h3></div>
        <div class="panel-body">
            <div>
                <a href="unitAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
                <a href="unitList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
                <a href="unitEdit.php?id=<?php echo $unit->id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;

                <a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete?');" href="unitDelete.php?id=<?php echo $unit->id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
            </div>&nbsp;&nbsp;
            <table id="table1" class="table-condensed table-responsive table-bordered grid">
                <tr>
                    <th>Name</th><td><a href="unitEdit.php?id=<?php echo $unit->id; ?>"> <?php echo "$unit->name"; ?></a></td>
                </tr>
                <tr>
                    <th>Section</th><td><a href="unitEdit.php?id=<?php echo $unit->id; ?>"> <?php echo "$unit->section_id"; ?></a></td>
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




