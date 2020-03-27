<?php
require '../model/page.php';
require '../validation/pageValidation.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
 if (isset($_POST['cancel'])) { redirect('pageList.php');}
$res = new pageValidation();
         $page=new Page();
     
	if(isset($_POST['submit'])){
                        $page->page_desc = $res->valInput($_POST['page_desc']);
                       
		if($res->validate($page)){
				//insert
				$page->addPage($page);
		}
	}
?>
<script type="text/javascript">

$(document).ready(function(){

	$('#page_desc').css('background-color','#fbf3ba');		
		
});

</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">ADD PAGE</h3>
		</div>
<div class="panel-body">
<?php 
if(empty($res->ERROR_MSG)){}  else {
echo '<div class="alert alert-danger">';
echo '<span>'.$res->ERROR_MSG.'</span>';  
echo '</div>';
}
 ?>
    <form id="form1" method="post" action="pageAdd.php" enctype="multipart/form-data">
<table class="table-condensed">
<tr>
	<td>
		<a href="pageList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; LIST</a>&nbsp;&nbsp;
	</td>
</tr>
<tr>
<th>Description</th>
<td><input name="page_desc" type="text" placeholder="Description" class="form-control input-sm" id="page_desc" value="<?php echo $page->page_desc; ?>" /></td>
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