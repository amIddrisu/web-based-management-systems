<?php
require '../service/findingService.php';
$findingService=new FindingService();
$all=FALSE;
 $registration='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$findingService->getDelete($csvRemoveAllIds,$all);
	
}else{
   
    //if($_GET['id']){
       
        $id = $_GET['id'];
        $registration=$findingService->getFinding($id)->finding_num;
	$findingService->getDelete($id,$all);
    }
	
//}
//redirect('findingList.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>Finding(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>Finding with registration: '.$registration.' successfully deleted.</font>'; 
}
?>
 <br><a href="findingList.php">Back To List</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>