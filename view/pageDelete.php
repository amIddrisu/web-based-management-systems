<?php
require '../model/page.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$page=new page();
$all=FALSE;
$desc='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$page->deletePage($csvRemoveAllIds,$all);
	
}else{
	$id = $_GET['id'];
        
        $desc=$page->getPage($id)->getPageName();
	$page->deletePage($id,$all);
}

redirect('../view/pageList.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>Page(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>Page with name: '.$desc.' successfully deleted.</font>'; 
}
?>
    <br><a href="pageList.php"> BACK TO LIST</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>