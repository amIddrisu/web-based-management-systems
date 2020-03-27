<?php
require_once '../controller/protocolAddController.php';
?>
<script type="text/javascript">

$(document).ready(function(){

	$('#scp_number').css('background-color','#fbf3ba');
        $('#pro_number').css('background-color','#fbf3ba');
        $('#dept_id').css('background-color','#fbf3ba');
        $('#section_id').css('background-color','#fbf3ba');		
	$('#unit_id').css('background-color','#fbf3ba');			
	$('#pro_reference').css('background-color','#fbf3ba');
        $('#pro_question').css('background-color','#fbf3ba');
		
});
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">Add A Protocol</h3>
		</div>
<div class="panel-body">
<?php 
if(empty($res->ERROR_MSG)){}  else {
echo '<div class="alert alert-danger">';
echo '<span><font  color="red" >'.$res->ERROR_MSG.'</font></span>';  
echo '</div>';
}
 ?>
 
<form id="form1" method="post" action="protocolAdd.php" enctype="multipart/form-data">
<table class="table-condensed">
<tr>
	<td>
<a href="protocolList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
	</td>
</tr>

<tr>
<th>Scope Number</th>
<td><select name="scp_number" type="text" placeholder="Scope Number" class="form-control input-sm" id="scp_number">
            <option value="">Select Scope Number</option>
            <?php  $protocolService->showScopeOptions(); ?>        
    </select></td>
</tr>

<tr>
<th>Protocol Number</th>
<td><input name="pro_number" type="text" id="pro_number" placeholder="Protocol Number" class="form-control input-sm" value="<?php echo $protocol->pro_number; ?>" /></td>
</tr>
<tr>
<th>Department</th>
<td><select name="dept_id" type="text" placeholder="Department" class="form-control input-sm" id="dept_id">
            <option value="">Select Department</option>
            <?php  $protocolService->showDepartmentOptions(); ?>        
    </select></td>
</tr>
<tr>
<th>Section</th>
<td><select name="section_id" type="text" placeholder="Section" class="form-control input-sm" id="section_id">
            <option value="">Select Section</option>
            <?php  $protocolService->showSectionOptions(); ?>        
    </select></td>
</tr>
<tr>
<th>Unit</th>
<td><select name="unit_id" type="text" placeholder="Unit" class="form-control input-sm" id="unit_id">
            <option value="">Select Unit</option>
            <?php  $protocolService->showUnitOptions(); ?>        
    </select></td>
</tr>
<tr>
<th>Protocol Reference</th>
<td><input name="pro_reference" type="text" id="pro_reference" placeholder="Protocol Reference" class="form-control input-sm" value="<?php echo $protocol->pro_reference; ?>" /></td>
</tr>
<tr>
<th>Protocol Question</th>
<td><input name="pro_question" type="text" id="pro_question" placeholder="Protocol Question" class="form-control input-sm" value="<?php echo $protocol->pro_question; ?>" /></td>
</tr>




<!--<tr>
<th>Helicopter</th>
<td><input name="helicopter" type="checkbox" <?php // if($protocol->helicopter===1 || $protocol->helicopter==1){
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