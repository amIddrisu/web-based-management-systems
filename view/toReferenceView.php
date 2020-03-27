<?php
require '../model/toReference.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
    $toReference = new ToReference();
if (isset($_GET['id'])) {
$id = $_GET['id'];
$toReference = $toReference->getToReference($id);
}
?>
<div class = "col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class = "panel panel-default">
        <div class = "panel-heading" style = "background-color: #428bca; color:#ffffff">
            <h3 class = "panel-title"> <b>Details of Terms of Reference</b></h3></div>
        <div class = "panel-body">
            <div>
                <a href = "toReferenceAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
                <a href = "toReferenceList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
                <a href = "toReferenceEdit.php?id=<?php echo $toReference->id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;

<a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete?');" href="toReferenceDelete.php?id=<?php echo $toReference->id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
</div>&nbsp;&nbsp;
<table id = "table1" class="table-condensed table-responsive table-bordered grid">
<tr>
<th>To</th>
<td> <?php echo "$toReference->tor_cc"; ?></td>
</tr>
<tr>
<th>Cc</th><td><?php echo "$toReference->tor_cc"; ?></td>
</tr>
<tr>
<th>Audit Date</th><td><?php echo "$toReference->audit_date"; ?></td>
</tr>
<tr>
<th>Audit Reference Number</th><td><?php echo "$toReference->audit_ref_num"; ?></td>
</tr>
<tr>
<th>Scope Number</th><td><?php echo "$toReference->scp_number"; ?></td>
</tr>
<tr>
<th>Department </th><td> <?php echo "$toReference->dept_id"; ?></td>
</tr>
<tr>
<th>Section</th><td><?php echo "$toReference->section_id"; ?></td>
</tr>
<tr>
<th>Unit</th><td> <?php echo "$toReference->unit_id"; ?></td>
</tr>
<tr>
 <th>Objective</th><td> <?php echo "$toReference->objective"; ?></td>
</tr>
<tr>
 <th>Assignment Strategy</th><td> <?php echo "$toReference->assignm_strategy"; ?></td>
</tr>
<tr>
 <th>Deliverables</th><td> <?php echo "$toReference->deliverables"; ?></td>
</tr>
<tr>
 <th>Report Distribution</th><td> <?php echo "$toReference->report_dist"; ?></td>
</tr>
<tr>
 <th>Overview Audit Cover</th><td> <?php echo "$toReference->overview_audit_cov"; ?></td>
</tr>
</table>
        </div>
    </div>
</div>
<?php
require '../include/footer.php';
?>




