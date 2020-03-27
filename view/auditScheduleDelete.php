<?php
require '../model/auditSchedule.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$auditSchedule = new AuditSchedule();
$all=FALSE;
$desc='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$auditSchedule->deleteAuditSchedule($csvRemoveAllIds,$all);
	
}else{
	$id = $_GET['id'];
        
        $desc=$auditSchedule->getAuditSchedule($id)->scp_number;
        
	$auditSchedule->deleteAuditSchedule($id,$all);
}


?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>Audit Schedule(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>Audit Schedule with scope number: '.$desc.' successfully deleted.</font>'; 
}
?>
    <br><a href="auditScheduleList.php"> BACK TO LIST</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>