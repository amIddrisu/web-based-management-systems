<?php
require '../model/unit.php';
require '../validation/unitValidation.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
 if (isset($_POST['cancel'])) { redirect('unitList.php');}
$res = new UnitValidation();
$unit = new Unit();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $unit= $unit->getUnit($id);
}

if (isset($_POST['submit'])) {
    $unit->id = $res->valInput($_POST['id']);
            $unit->name = $res->valInput($_POST['name']);
            $unit->section_id = $res->valInput($_POST['section_id']);
     
          
            

    if ($res->validate($unit)) {
        //insert
        $unit->editUnit($unit);
    }
}

?>
<script type="text/javascript">

$(document).ready(function(){

	$('#name').css('background-color','#fbf3ba');		
	$('#section_id').css('background-color','#fbf3ba');			
	
		
});
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">Edit An Unit</h3>
  </div>
<div class="panel-body">
<?php 
if(empty($res->ERROR_MSG)){}  else {
echo '<div class="alert alert-danger">';
echo '<span>'.$res->ERROR_MSG.'</span>';  
echo '</div>';
}
 ?>
<form  id="form1" method="post" action="unitEdit.php" enctype="multipart/form-data">
<table class="table-condensed">
<tr>
	<td>
<a href="unitList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
	</td>
</tr>
<tr>
<th>Name</th>
<td><input name="name" type="text" placeholder="Name" class="form-control input-sm" id="name" value="<?php echo $unit->name; ?>" /></td>
</tr>
<tr>
<th>Section</th>
<td><select name="section_id" type="text" placeholder="Section" class="form-control input-sm" id="section_id">
            <option value="">Select Section</option>
            <?php  $unit->showSectionOptions(); ?>        
    </select></td>
</tr>




<tr>
     <td>
</td>
<td>
    <input type="hidden" name="id" value="<?php echo $unit->id; ?>" />
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