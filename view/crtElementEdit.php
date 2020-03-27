<?php
require '../model/crtElement.php';
require '../validation/crtElementValidation.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
 if (isset($_POST['cancel'])) { redirect('crtElementList.php');}
$res = new CrtElementValidation();
$crtElement = new CrtElement();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $crtElement= $crtElement->getCrtElement($id);
}

if (isset($_POST['submit'])) {
    $crtElement->id = $res->valInput($_POST['id']);
            $crtElement->crt_area = $res->valInput($_POST['crt_area']);
            $crtElement->speciality = $res->valInput($_POST['speciality']);
            $crtElement->description = $res->valInput($_POST['description']);
          
          
            

    if ($res->validate($crtElement)) {
        //insert
        $crtElement->editCrtElement($crtElement);
    }
}

?>
<script type="text/javascript">

$(document).ready(function(){

	$('#crt_area').css('background-color','#fbf3ba');		
	$('#speciality').css('background-color','#fbf3ba');			
	$('#description').css('background-color','#fbf3ba');	
	
});
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">Edit A Critical Element</h3>
  </div>
<div class="panel-body">
<?php 
if(empty($res->ERROR_MSG)){}  else {
echo '<div class="alert alert-danger">';
echo '<span>'.$res->ERROR_MSG.'</span>';  
echo '</div>';
}
 ?>
<form  id="form1" method="post" action="crtElementEdit.php" enctype="multipart/form-data">
<table class="table-condensed">
<tr>
	<td>
		<a href="crtElementList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
	</td>
</tr>
<tr>
<th>Critical Area</th>
<td><input name="crt_area" type="text" placeholder="Critical Area" class="form-control input-sm" id="crt_area" value="<?php echo $crtElement->crt_area; ?>" /></td>
</tr>
<tr>
<th>speciality</th>
<td><input name="speciality" type="text" id="speciality" placeholder="Speciality" class="form-control input-sm" value="<?php echo $crtElement->speciality; ?>"/></td>
</tr>
<tr>
<th>Description</th>
<td><input name="description" type="text" id="description" placeholder="Description" class="form-control input-sm" value="<?php echo $crtElement->description; ?>"/></td>
</tr>
<tr>
     <td>
</td>
<td>
    <input type="hidden" name="id" value="<?php echo $crtElement->id; ?>" />
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