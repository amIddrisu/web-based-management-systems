<?php
require '../model/crtElement.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$crtElement = new CrtElement();
$all=FALSE;
$desc='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$crtElement->deleteCrtElement($csvRemoveAllIds,$all);
	
}else{
	$id = $_GET['id'];
        
        $desc=$crtElement->getCrtElement($id)->speciality;
        
	$crtElement->deleteCrtElement($id,$all);
}


?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>Critical Element(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>Critical Element with speciality: '.$desc.' successfully deleted.</font>'; 
}
?>
    <br><a href="crtElementList.php">Back To List</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>