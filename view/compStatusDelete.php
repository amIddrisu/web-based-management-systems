<?php
require '../model/compStatus.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$compStatus=new CompStatus();
$all=FALSE;
$desc='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$compStatus->deleteCompStatus($csvRemoveAllIds,$all);
	
}else{
	$id = $_GET['id'];
        
        $desc=$compStatus->getCompStatus($id)->getCompStatusName();
	$compStatus->deleteCompStatus($id,$all);
}

redirect('../view/compStatusList.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>CompStatus(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>CompStatus with name: '.$desc.' successfully deleted.</font>'; 
}
?>
    <br><a href="compStatusList.php"> BACK TO LIST</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>