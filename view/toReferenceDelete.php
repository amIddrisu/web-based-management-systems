<?php
require '../model/toReference.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$toReference = new ToReference();
$all=FALSE;
$desc='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$toReference->deleteToReference($csvRemoveAllIds,$all);
	
}else{
	$id = $_GET['id'];
        
        $desc=$toReference->getToReference($id)->scp_number;
        
	$toReference->deleteToReference($id,$all);
}


?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>Terms of Reference(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>Terms of Reference with scope number: '.$desc.' successfully deleted.</font>'; 
}
?>
    <br><a href="toReferenceList.php">Back To Terms Of Reference List</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>