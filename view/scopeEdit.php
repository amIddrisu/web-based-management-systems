<?php
require '../controller/scopeEditController.php';
?>
<script type="text/javascript">

$(document).ready(function(){

	$('#scp_number').css('background-color','#fbf3ba');		
	$('#description').css('background-color','#fbf3ba');			
	$('#dept_id').css('background-color','#fbf3ba');	
        $('#section_id').css('background-color','#fbf3ba');		
	$('#unit_id').css('background-color','#fbf3ba');			
	
		
});
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">Edit A Scope</h3>
  </div>
<div class="panel-body">
<?php 
if(empty($res->ERROR_MSG)){}  else {
echo '<div class="alert alert-danger">';
echo '<span>'.$res->ERROR_MSG.'</span>';  
echo '</div>';
}
 ?>
<form  id="form1" method="post" action="scopeEdit.php" enctype="multipart/form-data">
<table class="table-condensed">
<tr>
	<td>
		<a href="scopeList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;LIST</a>&nbsp;&nbsp;
	</td>
</tr>
<tr>
<th>Scope Number</th>
<td><input name="scp_number" type="text" placeholder="Scope Number" class="form-control input-sm" id="scp_number" value="<?php echo $scope->scp_number; ?>" /></td>
</tr>

<tr>
<th>Description</th>
<td><input name="description" type="text" id="description" placeholder="Description" class="form-control input-sm" value="<?php echo $scope->description; ?>" /></td>
</tr>
<tr>
<th>Department</th>
<td><select name="dept_id" type="text" placeholder="Department" class="form-control input-sm" id="dept_id">
            <option value="">Select Department</option>
            <?php  $scopeService->showDepartmentOptions(); ?>        
    </select></td>
</tr>
<tr>
<th>Section</th>
<td><select name="section_id" type="text" placeholder="Section" class="form-control input-sm" id="section_id">
            <option value="">Select Section</option>
            <?php  $scopeService->showSectionOptions(); ?>        
    </select></td>
</tr>
<tr>
<th>Unit</th>
<td><select name="unit_id" type="text" placeholder="Unit" class="form-control input-sm" id="unit_id">
            <option value="">Select Unit</option>
            <?php  $scopeService->showUnitOptions(); ?>        
    </select></td>
</tr>


<tr>
     <td>
</td>
<td>
    <input type="hidden" name="id" value="<?php echo $scope->id; ?>" />
    <button type="submit" class="btn btn-info btn-sm" style="background-color: #428bca" name="submit"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save</button>
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