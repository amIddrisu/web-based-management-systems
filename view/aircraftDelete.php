<?php
require '../service/aircraftService.php';
$aircraftService=new aircraftService();
$all=FALSE;
 $registration='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$aircraftService->getDelete($csvRemoveAllIds,$all);
	
}else{
   
    if($_GET['id']){
       
        $id = $_GET['id'];
        $registration=$aircraftService->getAircraft($id)->getName();
	$aircraftService->getDelete($id,$all);
    }
	
}
redirect('aircraftList.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>Aircraft(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>Aircraft with registration: '.$registration.' successfully deleted.</font>'; 
}
?>
 <br><a href="aircraftList.php"> BACK TO LIST</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>