<?php
require '../model/auditSchedule.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
    $auditSchedule = new AuditSchedule();
if (isset($_GET['id'])) {
$id = $_GET['id'];
$auditSchedule = $auditSchedule->getAuditSchedule($id);
}
?>
<div class = "col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class = "panel panel-default">
        <div class = "panel-heading" style = "background-color: #428bca; color:#ffffff">
            <h3 class = "panel-title"> <b>Details of Audit Schedule</b></h3></div>
        <div class = "panel-body">
            <div>
                <a href = "auditScheduleAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
                <a href = "auditScheduleList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
                <a href = "auditScheduleEdit.php?id=<?php echo $auditSchedule->id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;

                <a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete?');" href="auditScheduleDelete.php?id=<?php echo $auditSchedule->id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
            </div>&nbsp;&nbsp;
<table id = "table1" class="table-condensed table-responsive table-bordered grid">
<tr>
<th>From</th>
<td> <?php echo "$auditSchedule->from_date"; ?></td>
</tr>
<tr>
<th>Scope Number</th><td><?php echo "$auditSchedule->scp_number"; ?></td>
</tr>
<tr>
<th>Department </th><td> <?php echo "$auditSchedule->dept_id"; ?></td>
</tr>
<tr>
<th>Section</th><td><?php echo "$auditSchedule->section_id"; ?></td>
</tr>
<tr>
<th>Unit</th><td> <?php echo "$auditSchedule->unit_id"; ?></td>
</tr>
<tr>
 <th>To</th><td> <?php echo "$auditSchedule->to_date"; ?></td>
</tr>
</table>
        </div>
    </div>
</div>
<?php
require '../include/footer.php';
?>




