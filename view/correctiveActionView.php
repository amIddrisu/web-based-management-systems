<?php
require '../model/correctiveAction.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
    $correctiveAction=new CorrectiveAction();
if (isset($_GET['id'])) {
$id=$_GET['id'];
$correctiveAction=$correctiveAction->getCorrectiveAction($id);
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title"> <b>Details of A Corrective Action</b></h3></div>
        <div class="panel-body">
            <div>
                <a href="correctiveActionAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
                <a href="correctiveActionList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
                <a href="correctiveActionEdit.php?id=<?php echo $correctiveAction->id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;

                <a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete?');" href="correctiveActionDelete.php?id=<?php echo $correctiveAction->id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
            </div>&nbsp;&nbsp;
            <table id="table1" class="table-condensed table-responsive table-bordered grid">
                <tr>
                    <th>Finding Number</th><td><a href="correctiveActionEdit.php?id=<?php echo $correctiveAction->id; ?>"> <?php echo "$correctiveAction->finding_num"; ?></a></td>
                </tr>
                <tr>
                    <th>Status</th><td><a href="correctiveActionEdit.php?id=<?php echo $correctiveAction->id; ?>"> <?php echo "$correctiveAction->status"; ?></a></td>
                </tr>
                <tr>
                    <th>Description</th><td><a href="correctiveActionEdit.php?id=<?php echo $correctiveAction->id; ?>"> <?php echo "$correctiveAction->description"; ?></a></td>
                </tr>
                <tr>
                    <th>Finding Priority</th><td><a href="correctiveActionEdit.php?id=<?php echo $correctiveAction->id; ?>"> <?php echo "$correctiveAction->finding_priority"; ?></a></td>
                </tr>
                <tr>
                    <th>Start Date</th><td><a href="correctiveActionEdit.php?id=<?php echo $correctiveAction->id; ?>"> <?php echo "$correctiveAction->start_date"; ?></a></td>
                </tr>
                <tr>
                    <th>Finding priority Date</th><td><a href="correctiveActionEdit.php?id=<?php echo $correctiveAction->id; ?>"> <?php echo "$correctiveAction->finding_priority_date"; ?></a></td>
                </tr>
                <tr>
                    <th>Finish Date</th><td><a href="correctiveActionEdit.php?id=<?php echo $correctiveAction->id; ?>"> <?php echo "$correctiveAction->finish_date"; ?></a></td>
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




