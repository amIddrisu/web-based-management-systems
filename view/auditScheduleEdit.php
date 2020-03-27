<?php
require '../model/auditSchedule.php';
require '../validation/auditScheduleValidation.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
 if (isset($_POST['cancel'])) { redirect('auditScheduleList.php');}
$res = new AuditScheduleValidation();
$auditSchedule = new AuditSchedule();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $auditSchedule= $auditSchedule->getAuditSchedule($id);
}

if (isset($_POST['submit'])) {
    $auditSchedule->id = $res->valInput($_POST['id']);
            $auditSchedule->from_date = $res->valInput($_POST['from_date']);
            $auditSchedule->scp_number = $res->valInput($_POST['scp_number']);
            $auditSchedule->dept_id = $res->valInput($_POST['dept_id']);
            $auditSchedule->section_id = $res->valInput($_POST['section_id']);
                  $auditSchedule->unit_id = $res->valInput($_POST['unit_id']);
            $auditSchedule->to_date = $res->valInput($_POST['to_date']);
          
            

    if ($res->validate($auditSchedule)) {
        //insert
        $auditSchedule->editAuditSchedule($auditSchedule);
    }
}

?>
<script type="text/javascript">

$(document).ready(function(){

	$('#from_date').css('background-color','#fbf3ba');		
	$('#scp_number').css('background-color','#fbf3ba');			
	$('#dept_id').css('background-color','#fbf3ba');	
	$('#section_id').css('background-color','#fbf3ba');
        $('#unit_id').css('background-color','#fbf3ba');	
	$('#to_date').css('background-color','#fbf3ba');
		
});
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">Edit An Audit Schedule</h3>
  </div>
<div class="panel-body">
<?php 
if(empty($res->ERROR_MSG)){}  else {
echo '<div class="alert alert-danger">';
echo '<span>'.$res->ERROR_MSG.'</span>';  
echo '</div>';
}
 ?>
<form  id="form1" method="post" action="auditScheduleEdit.php" enctype="multipart/form-data">
<table class="table-condensed">
<tr>
	<td>
		<a href="auditScheduleList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
	</td>
</tr>
<tr>
<th>From</th>
<td><input name="from_date" type="text" placeholder="From" class="form-control input-sm" id="from_date" value="<?php echo $auditSchedule->from_date; ?>" /></td>
</tr>
<tr>
<th>Scope Number</th>
<td><select name="scp_number" type="text" placeholder="Scope Number" class="form-control input-sm" id="scp_number">
            <option value="">Select Scope Number</option>
            <?php  $auditSchedule->showScopeOptions(); ?>        
    </select></td>
</tr>

<tr>
<th>Department</th>
<td><select name="dept_id" type="text" placeholder="Department" class="form-control input-sm" id="dept_id">
            <option value="">Select Department</option>
            <?php  $auditSchedule->showDepartmentOptions(); ?>        
    </select></td>
</tr>
<tr>
<th>Section</th>
<td><select name="section_id" type="text" placeholder="Section" class="form-control input-sm" id="section_id">
            <option value="">Select Section</option>
            <?php  $auditSchedule->showSectionOptions(); ?>        
    </select></td>
</tr>
<tr>
<th>Unit</th>
<td><select name="unit_id" type="text" placeholder="Unit" class="form-control input-sm" id="unit_id">
            <option value="">Select Unit</option>
            <?php  $auditSchedule->showUnitOptions(); ?>        
    </select></td>
</tr>


<tr>
<th>To</th>
<td><input name="to_date" type="text" id="to_date" placeholder="To" class="form-control input-sm" value="<?php echo $auditSchedule->to_date; ?>"/></td>
</tr>

<tr>
     <td>
</td>
<td>
    <input type="hidden" name="id" value="<?php echo $auditSchedule->id; ?>" />
    <button type="submit" class="btn btn-info btn-sm" style="background-color: #428bca" name="submit"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save</button>
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