<?php
require '../model/section.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$section = new Section();
$all=FALSE;
$desc='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$section->deleteSection($csvRemoveAllIds,$all);
	
}else{
	$id = $_GET['id'];
        
        $desc=$section->getSection($id)->name;
	$section->deleteSection($id,$all);
}

redirect('../view/sectionList.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font>Section(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>Section with name: '.$desc.' successfully deleted.</font>'; 
}
?>
    <br><a href="sectionList.php"> Back To List</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>