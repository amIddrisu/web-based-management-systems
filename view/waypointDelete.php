<?php
require '../model/waypoint.php';
$waypoint=new waypoint();

if(isset($_POST['checkbox'])){
	$removeAllId = $_POST['checkbox'];
	$csvRemoveAllIds = implode("','",$removeAllId);	
	$csvRemoveAllIds = "'".$csvRemoveAllIds."'";
		
	$waypoint->deletePage($csvRemoveAllIds,true);
	
}else{
	$id = $_GET['id'];
	$waypoint->deleteWaypoint($id,false);
}

redirect('../view/waypointList.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="bs-callout bs-callout-info">
<?php
//TODO display meaningful text here instead of ID
echo '<font>Record with ID: '.$_GET['id'].' successfully deleted.</font>';
?>
    <br><a href="waypointList.php"> BACK TO LIST</a><br>
 </div>
 </div>
<?php 
require '../include/footer.php';
?>