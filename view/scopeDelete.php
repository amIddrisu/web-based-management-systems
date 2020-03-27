<?php
require '../service/scopeService.php';
$scopeService = new ScopeService();
$all=FALSE;
 $registration='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$scopeService->getDelete($csvRemoveAllIds,$all);
	
}else{
   
    if($_GET['id']){
       
        $id = $_GET['id'];
        $registration=$scopeService->getScope($id)->scp_number;
	$scopeService->getDelete($id,$all);
    }
	
}
//redirect('scopeList.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>Scope(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>Scope with registration: '.$registration.' successfully deleted.</font>'; 
}
?>
 <br><a href="scopeList.php"> Back To Scopes List Page</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>