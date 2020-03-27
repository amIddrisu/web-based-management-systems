<?php
require '../controller/aircraftEditController.php';
?>
<script type="text/javascript">

$(document).ready(function(){

	$('#name').css('background-color','#fbf3ba');		
	$('#aircrafttype').css('background-color','#fbf3ba');			
	$('#weight').css('background-color','#fbf3ba');	
		
});
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">AIRCRAFT EDIT</h3>
  </div>
<div class="panel-body">
<?php 
if(empty($res->ERROR_MSG)){}  else {
echo '<div class="alert alert-danger">';
echo '<span>'.$res->ERROR_MSG.'</span>';  
echo '</div>';
}
 ?>
<form  id="form1" method="post" action="aircraftEdit.php" enctype="multipart/form-data">
<table class="table-condensed">
<tr>
	<td>
		<a href="aircraftList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;LIST</a>&nbsp;&nbsp;
	</td>
</tr>
<tr>
<th>Registration</th>
<td><input name="name" type="text" placeholder="Registration" class="form-control input-sm" id="name" value="<?php echo $aircraft->name; ?>" /></td>
</tr>
<tr>
<th>Aircraft Type</th>
<td><input name="aircrafttype" type="text" id="aircrafttype" placeholder="Aircraft Type" class="form-control input-sm" value="<?php echo $aircraft->aircrafttype; ?>" /></td>
</tr>
<tr>
<th>Maximum takeoff weight (MTOW)</th>
<td><input name="weight" type="text" id="weight" placeholder="Weight" class="form-control input-sm" value="<?php echo $aircraft->weight; ?>"/></td>
</tr>
<tr>
<th>UOM</th>
<td><input name="uom" type="text" id="uom" placeholder="UOM" class="form-control input-sm" value="<?php echo $aircraft->uom; ?>" /></td>
</tr>
<tr>
<th>Helicopter</th>
<td><input name="helicopter" type="checkbox" <?php if($aircraft->helicopter===1 || $aircraft->helicopter==1){
                                echo 'checked="checked"';}?> placeholder="Helicopter" class="form-control input-sm" id="helicopter" value="<?php echo $aircraft->helicopter; ?>" /></td>
                   
</tr>
<tr>
     <td>
</td>
<td>
    <input type="hidden" name="id" value="<?php echo $aircraft->id; ?>" />
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