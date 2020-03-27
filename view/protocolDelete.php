<?php
require '../service/protocolService.php';
$protocolService = new ProtocolService();
$all=FALSE;
 $registration='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$protocolService->getDelete($csvRemoveAllIds,$all);
	
}else{
   
    if($_GET['id']){
       
        $id = $_GET['id'];
        $registration=$protocolService->getProtocol($id)->pro_number;
	$protocolService->getDelete($id,$all);
    }
	
}
//redirect('protocolList.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>Protocol(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>Protocol with registration: '.$registration.' successfully deleted.</font>'; 
}
?>
 <br><a href="protocolList.php"> BACK TO LIST</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>