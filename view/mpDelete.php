<?php
require '../model/role_perm.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$role_perm=new role_perm();

if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
		
	$role_perm->deleteRolePagePerm($csvRemoveAllIds,true);
	
}else{
	$id = $_GET['id'];
	$role_perm->deleteRolePagePerm($id,false);
}

redirect('../view/mpList.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
//TODO display meaningful text here instead of ID
echo '<font>Record with ID: '.$_GET['id'].' successfully deleted.</font>';
?>
    <br><a href="mpList.php"> BACK TO LIST</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>