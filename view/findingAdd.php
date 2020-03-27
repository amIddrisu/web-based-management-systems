<?php
require_once '../controller/findingAddController.php';
?>
<script type="text/javascript">

$(document).ready(function(){

	$('#finding_num').css('background-color','#fbf3ba');
        $('#pro_number').css('background-color','#fbf3ba');
        $('#audit_ref_num').css('background-color','#fbf3ba');
        $('#description').css('background-color','#fbf3ba');		
	$('#recommendation').css('background-color','#fbf3ba');			
	$('#evidence').css('background-color','#fbf3ba');
      
		
});
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">Add A Finding</h3>
		</div>
<div class="panel-body">
<?php 
if(empty($res->ERROR_MSG)){}  else {
echo '<div class="alert alert-danger">';
echo '<span><font  color="red" >'.$res->ERROR_MSG.'</font></span>';  
echo '</div>';
}
 ?>
 
<form id="form1" method="post" action="findingAdd.php" enctype="multipart/form-data">
<table class="table-condensed">
<tr>
	<td>
<a href="findingList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
	</td>
</tr>

<tr>
<th>Finding Number</th>
<td><input name="finding_num" type="text" placeholder="Finding Number" class="form-control input-sm" id="finding_num" value="<?php echo $finding->finding_num; ?>" /></td>
</tr>

<tr>
<th>Protocol Number</th>
<td><select name="pro_number" type="text" placeholder="Protocol Number" class="form-control input-sm" id="pro_number">
            <option value="">Select Protocol Number</option>
            <?php  $findingService->showProtocolOptions(); ?>        
    </select></td>
</tr>
<tr>
<th>Audit Reference Number</th>
<td><input name="audit_ref_num" type="text" id="audit_ref_num" placeholder="Audit Reference Number" class="form-control input-sm" value="<?php echo $finding->audit_ref_num; ?>" /></td>
</tr>
<tr>
<th>Description</th>
<td><input name="description" type="text" id="description" placeholder="Description" class="form-control input-sm" value="<?php echo $finding->description; ?>" /></td>
</tr>
<tr>
<th>Recommendation</th>
<td><input name="recommendation" type="text" id="recommendation" placeholder="Recommendation" class="form-control input-sm" value="<?php echo $finding->recommendation; ?>" /></td>
</tr>
<tr>
<th>Evidence</th>
<td><input name="evidence" type="text" id="evidence" placeholder="Evidence" class="form-control input-sm" value="<?php echo $finding->evidence; ?>" /></td>
</tr>




<!--<tr>
<th>Helicopter</th>
<td><input name="helicopter" type="checkbox" <?php // if($finding->helicopter===1 || $finding->helicopter==1){
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