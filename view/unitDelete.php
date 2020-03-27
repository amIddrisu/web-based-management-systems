<?php
require '../model/unit.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$unit = new Unit();
$all=FALSE;
$desc='';
if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
	$all=TRUE;	
	$unit->deleteUnit($csvRemoveAllIds,$all);
	
}else{
	$id = $_GET['id'];
        
        $desc=$unit->getUnit($id)->name;
	$unit->deleteUnit($id,$all);
}

//redirect('../view/unitList.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
if($all){
    echo '<font> Unit(s) records selected are successfully deleted.</font>'; 
}else{
   echo '<font>Unit with name: '.$desc.' successfully deleted.</font>'; 
}
?>
    <br><a href="unitList.php">Go Back To Units List.</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>