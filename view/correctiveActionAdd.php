<?php
require '../model/correctiveAction.php';
require '../validation/correctiveActionValidation.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
 if (isset($_POST['cancel'])) { redirect('correctiveActionList.php');}
$res = new CorrectiveActionValidation();
         $correctiveAction=new CorrectiveAction();

	if(isset($_POST['submit'])){
                        $correctiveAction->finding_num = $res->valInput($_POST['finding_num']);
                        $correctiveAction->status = $res->valInput($_POST['status']);
                        $correctiveAction->description = $res->valInput($_POST['description']);
                        $correctiveAction->finding_priority = $res->valInput($_POST['finding_priority']);
                        $correctiveAction->start_date = $res->valInput($_POST['start_date']);
                        $correctiveAction->finding_priority_date = $res->valInput($_POST['finding_priority_date']);
                        $correctiveAction->finish_date = $res->valInput($_POST['finish_date']);
                       
		if($res->validate($correctiveAction)){
				//insert
				$correctiveAction->addCorrectiveAction($correctiveAction);
		}
	}

?>
<script type="text/javascript">

$(document).ready(function(){

	$('#finding_num').css('background-color','#fbf3ba');
        $('#status').css('background-color','#fbf3ba');		
	$('#description').css('background-color','#fbf3ba');			
	$('#finding_priority').css('background-color','#fbf3ba');
        $('#start_date').css('background-color','#fbf3ba');
        $('#finding_priority_date').css('background-color','#fbf3ba');
        $('#finish_date').css('background-color','#fbf3ba');
		
});
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">Add A Corrective Action</h3>
		</div>
<div class="panel-body">
<?php 
if(empty($res->ERROR_MSG)){}  else {
echo '<div class="alert alert-danger">';
echo '<span><font  color="red" >'.$res->ERROR_MSG.'</font></span>';  
echo '</div>';
}
 ?>
 
<form id="form1" method="post" action="correctiveActionAdd.php" enctype="multipart/form-data">
<table class="table-condensed">
<tr>
	<td>
<a href="correctiveActionList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
	</td>
</tr>
<tr>
<th>Finding Number</th>
<td><select name="finding_num" type="text" placeholder="Finding Number" class="form-control input-sm" id="finding_num">
            <option value="">Select Finding Number</option>
            <?php  $correctiveAction->showFindingOptions(); ?>        
    </select></td>
</tr>

<tr>
<th>Status</th>
<td><input name="status" type="text" placeholder="Status" class="form-control input-sm" id="status" value="<?php echo $correctiveAction->status; ?>" /></td>
</tr>
<tr>
<th>Description</th>
<td><input name="description" type="text" placeholder="Description" class="form-control input-sm" id="description" value="<?php echo $correctiveAction->description; ?>" /></td>
</tr>
<tr>
<th>Finding Priority</th>
<td><input name="finding_priority" type="text" placeholder="Finding Priority" class="form-control input-sm" id="finding_priority" value="<?php echo $correctiveAction->finding_priority; ?>" /></td>
</tr>
<tr>
<th>Start Date</th>
<td><input name="start_date" type="text" id="start_date" placeholder="Start Date" class="form-control input-sm" value="<?php echo $correctiveAction->start_date; ?>"/></td>
</tr>
<tr>
<th>Finding Priority Date</th>
<td><input name="finding_priority_date" type="text" id="finding_priority_date" placeholder="Finding Priority Date" class="form-control input-sm" value="<?php echo $correctiveAction->finding_priority_date; ?>"/></td>
</tr>
<tr>
<th>Finish Date</th>
<td><input name="finish_date" type="text" id="finish_date" placeholder="Finish Date" class="form-control input-sm" value="<?php echo $correctiveAction->finish_date; ?>"/></td>
</tr>




<!--<tr>
<th>Helicopter</th>
<td><input name="helicopter" type="checkbox" <?php // if($correctiveAction->helicopter===1 || $correctiveAction->helicopter==1){
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