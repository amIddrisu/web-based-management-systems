<?php
require '../model/department.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$department = new Department();
$all=FALSE;
$desc='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$department->deleteDepartment($csvRemoveAllIds,$all);
	
}else{
	$id = $_GET['id'];
        
        $desc=$department->getDepartment($id)->name;
	$department->deleteDepartment($id,$all);
}

//redirect('../view/departmentList.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>Department(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>Department with name: '.$desc.' successfully deleted.</font>'; 
}
?>
    <br><a href="departmentList.php"> Back To List</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>