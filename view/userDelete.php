<?php
require '../service/userService.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$userService=new userService();
$all=FALSE;
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$userService->getDelete($csvRemoveAllIds,$all);
        redirect('userList.php');
	
}else{
   
    if($_GET['id']){
        
        $id = $_GET['id'];
        $fullName=$userService->getUser($id)->getFullname();
	$userService->getDelete($id,$all);
    }
	
}

?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>User(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>User : '.$fullName.' successfully deleted.</font>'; 
}
?>
 <br><a href="userList.php"> BACK TO LIST</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>