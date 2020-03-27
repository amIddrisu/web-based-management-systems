<?php
require '../model/toReference.php';
require '../validation/toReferenceValidation.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
 if (isset($_POST['cancel'])) { redirect('toReferenceList.php');}
$res = new ToReferenceValidation();
         $toReference=new ToReference();
     
	if(isset($_POST['submit'])){
                        $toReference->tor_to = $res->valInput($_POST['tor_to']);
                        $toReference->tor_cc = $res->valInput($_POST['tor_cc']);
                        $toReference->audit_date = $res->valInput($_POST['audit_date']);
                        $toReference->audit_ref_num = $res->valInput($_POST['audit_ref_num']);
                        $toReference->scp_number = $res->valInput($_POST['scp_number']);
                        $toReference->dept_id = $res->valInput($_POST['dept_id']);
                        $toReference->section_id = $res->valInput($_POST['section_id']);
                        $toReference->unit_id = $res->valInput($_POST['unit_id']);
                        $toReference->objective = $res->valInput($_POST['objective']);
                        $toReference->assignm_strategy = $res->valInput($_POST['assignm_strategy']);
                        $toReference->deliverables = $res->valInput($_POST['deliverables']);
                        $toReference->report_dist = $res->valInput($_POST['report_dist']);
                        $toReference->overview_audit_cov = $res->valInput($_POST['overview_audit_cov']);
               
                       
		if($res->validate($toReference)){
				//insert
				$toReference->addToReference($toReference);
                                 $desc=$toReference->getToReference($id)->scp_number;
		}
	}

?>
<script type="text/javascript">

$(document).ready(function(){

	$('#tor_to').css('background-color','#fbf3ba');
        $('#tor_cc').css('background-color','#fbf3ba');		
	$('#audit_date').css('background-color','#fbf3ba');			
	$('#audit_ref_num').css('background-color','#fbf3ba');
        $('#scp_number').css('background-color','#fbf3ba');
       	$('#dept_id').css('background-color','#fbf3ba');			
	$('#section_id').css('background-color','#fbf3ba');
        $('#unit_id').css('background-color','#fbf3ba');
        $('#objective').css('background-color','#fbf3ba');
        $('#assignm_strategy').css('background-color','#fbf3ba');
        $('#deliverables').css('background-color','#fbf3ba');
        $('#report_dist').css('background-color','#fbf3ba');
        $('#overview_audit_cov').css('background-color','#fbf3ba');
      
		
});
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<div class="panel panel-info">
<div class="panel-heading" style="background-color: #428bca; color:#ffffff">
<h3 class="panel-title">Add A Terms of Reference</h3>
		</div>
<div class="panel-body">
<?php 
if(empty($res->ERROR_MSG)){}  else {
echo '<div class="alert alert-danger">';
echo '<span><font  color="red" >'.$res->ERROR_MSG.'</font></span>';  
echo '</div>';
}
 ?>
 
<form id="form1" method="post" action="toReferenceAdd.php" enctype="multipart/form-data">
<table class="table-condensed">
<tr>
	<td>
<a href="toReferenceList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
	</td>
</tr>
<tr>
<th>To</th>
<td><input name="tor_to" type="text" placeholder="To" class="form-control input-sm" id="tor_to" value="<?php echo $toReference->tor_to; ?>" /></td>
</tr>
<tr>
<th>Cc</th>
<td><input name="tor_cc" type="text" placeholder="Cc" class="form-control input-sm" id="tor_cc" value="<?php echo $toReference->tor_cc; ?>" /></td>
</tr>
<tr>
<th>Audit Date</th>
<td><input name="audit_date" type="text" placeholder="Audit Date" class="form-control input-sm" id="audit_date" value="<?php echo $toReference->audit_date; ?>" /></td>
</tr>
<tr>
<th>Audit Reference Number</th>
<td><input name="audit_ref_num" type="text" placeholder="Audit Reference Number" class="form-control input-sm" id="audit_ref_num" value="<?php echo $toReference->audit_ref_num; ?>" /></td>
</tr>
<tr>
<th>Scope Number</th>
<td><select name="scp_number" type="text" placeholder="Scope Number" class="form-control input-sm" id="scp_number">
            <option value="">Select Scope Number</option>
            <?php  $toReference->showScopeOptions(); ?>        
    </select></td>
</tr>

<tr>
<th>Department</th>
<td><select name="dept_id" type="text" placeholder="Department" class="form-control input-sm" id="dept_id">
            <option value="">Select Department</option>
            <?php  $toReference->showDepartmentOptions(); ?>        
    </select></td>
</tr>
<tr>
<th>Section</th>
<td><select name="section_id" type="text" placeholder="Section" class="form-control input-sm" id="section_id">
            <option value="">Select Section</option>
            <?php  $toReference->showSectionOptions(); ?>        
    </select></td>
</tr>
<tr>
<th>Unit</th>
<td><select name="unit_id" type="text" placeholder="Unit" class="form-control input-sm" id="unit_id">
            <option value="">Select Unit</option>
            <?php  $toReference->showUnitOptions(); ?>        
    </select></td>
</tr>


<tr>
<th>Objective</th>
<td><input name="objective" type="text" id="objective" placeholder="Objective" class="form-control input-sm" value="<?php echo $toReference->objective; ?>"/></td>
</tr>
<tr>
<th>Assignment Strategy</th>
<td><input name="assignm_strategy" type="text" id="assignm_strategy" placeholder="Assignment Strategy" class="form-control input-sm" value="<?php echo $toReference->assignm_strategy; ?>"/></td>
</tr>
<tr>
<th>Deliverables</th>
<td><input name="deliverables" type="text" id="deliverables" placeholder="Deliverables" class="form-control input-sm" value="<?php echo $toReference->deliverables; ?>"/></td>
</tr>
<tr>
<th>Report Distribution</th>
<td><input name="report_dist" type="text" id="report_dist" placeholder="Report Distribution" class="form-control input-sm" value="<?php echo $toReference->report_dist; ?>"/></td>
</tr>
<tr>
<th>Overview Audit Cover</th>
<td><input name="overview_audit_cov" type="text" id="overview_audit_cov" placeholder="Overview Audit Cover" class="form-control input-sm" value="<?php echo $toReference->overview_audit_cov; ?>"/></td>
</tr>



<!--<tr>
<th>Helicopter</th>
<td><input name="helicopter" type="checkbox" <?php // if($toReference->helicopter===1 || $toReference->helicopter==1){
//                                echo 'checked="checked"';}?> placeholder="Helicopter" class="form-control input-sm" id="helicopter" value="1" /></td>
                   
</tr>-->

<tr>
    <td>
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