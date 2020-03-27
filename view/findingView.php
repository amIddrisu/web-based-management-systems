<?php
require '../service/findingService.php';
$findingService = new FindingService();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $finding = $findingService->getFinding($id);
}
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title"> <b>Details of Finding</b></h3></div>
<div class="panel-body">
                
                <div>
                    <a href="findingAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
                    <a href="findingList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
                    <a href="findingEdit.php?id=<?php echo  $finding->id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>
                    <a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete?');" href="findingDelete.php?id=<?php echo $finding->id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
                </div>&nbsp;&nbsp;
<table id="table1" class="table-condensed table-responsive table-bordered grid">
       
<tr>
<th>Finding Number</th><td><?php echo "$finding->finding_num"; ?></a></td>
</tr>
<tr>
<th>Protocol Number</th><td><?php echo "$finding->pro_number"; ?></td>
</tr>
<tr>
<th>Audit Reference Number:</th><td><?php echo "$finding->audit_ref_num"; ?></td>
</tr>
<tr>
<th>Description</th><td><?php echo "$finding->description"; ?></td>
</tr>
<tr>
<th>Recommendation</th><td><?php echo "$finding->recommendation"; ?></td>
</tr>
<tr>
<th>Evidence</th><td><?php echo "$finding->evidence" ;?></td>
</tr>



<!--<tr>
<th>Helicopter:</th><td><?php // if ($finding->helicopter==1) {
//			echo 'Helicopter';
//		}else {echo 'N/A';} ?></td>
</tr>-->
<tr>
</tr>
<tr>
</tr>
</table>
</div>
    </div>
</div>
<?php 
require '../include/footer.php';
?>


