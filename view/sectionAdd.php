<?php
require '../model/section.php';
require '../validation/sectionValidation.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
 if (isset($_POST['cancel'])) { redirect('sectionList.php');}
$res = new SectionValidation();
         $section=new Section();
     
	if(isset($_POST['submit'])){
                        $section->name = $res->valInput($_POST['name']);
                        $section->dept_id = $res->valInput($_POST['dept_id']);
                       
		if($res->validate($section)){
				//insert
				$section->addSection($section);
		}
	}
?>
<script type="text/javascript">

$(document).ready(function(){

	$('#name').css('background-color','#fbf3ba');		
	$('#dept_id').css('background-color','#fbf3ba');
});

</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">Add A Section</h3>
		</div>
<div class="panel-body">
<?php 
if(empty($res->ERROR_MSG)){}  else {
echo '<div class="alert alert-danger">';
echo '<span>'.$res->ERROR_MSG.'</span>';  
echo '</div>';
}
 ?>
    <form id="form1" method="post" action="sectionAdd.php" enctype="multipart/form-data">
<table class="table-condensed">
<tr>
	<td>
		<a href="sectionList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
	</td>
</tr>
<tr>
<th>Name</th>
<td><input name="name" type="text" placeholder="Name" class="form-control input-sm" id="name" value="<?php echo $section->name;?>"/></td>
</tr>

<tr>
<th>Department</th>
<td><select name="dept_id" type="text" placeholder="Department" class="form-control input-sm" id="dept_id">
            <option value="">Select Department</option>
            <?php  $section->showDepartmentOptions(); ?>        
    </select></td>
</tr>
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