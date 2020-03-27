<?php
require '../model/correctiveAction.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$correctiveAction=new CorrectiveAction();
$all=FALSE;
$desc='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$correctiveAction->deleteCorrectiveAction($csvRemoveAllIds,$all);
	
}else{
	$id = $_GET['id'];
        
        $desc=$correctiveAction->getCorrectiveAction($id)->description;
	$correctiveAction->deleteCorrectiveAction($id,$all);
}

//redirect('../view/correctiveActionList.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>Corrective Action(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>Corrective Action with name: '.$desc.' successfully deleted.</font>'; 
}
?>
    <br><a href="correctiveActionList.php"> BACK TO LIST</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>