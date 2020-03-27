<?php
require '../service/scopeService.php';
$scopeService = new ScopeService();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $scope = $scopeService->getScope($id);
}
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title"> <b>Details of Scope</b></h3></div>
<div class="panel-body">
                
                <div>
                    <a href="scopeAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
                    <a href="scopeList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
                    <a href="scopeEdit.php?id=<?php echo  $scope->id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>
                    <a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete?');" href="scopeDelete.php?id=<?php echo $scope->id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
                </div>&nbsp;&nbsp;
<table id="table1" class="table-condensed table-responsive table-bordered grid">
       
<tr>
<th>Scope Number</th><td><?php echo "$scope->scp_number"; ?></a></td>
</tr>
<tr>
<th>Description</th><td><?php echo "$scope->description"; ?></a></td>
</tr>
<tr>
<th>Department</th><td><?php echo "$scope->dept_id"; ?></td>
</tr>
<tr>
<th>Section</th><td><?php echo "$scope->section_id"; ?></td>
</tr>
<tr>
<th>Unit</th><td><?php echo "$scope->unit_id"; ?></td>
</tr>





<!--<tr>
<th>Helicopter:</th><td><?php // if ($scope->helicopter==1) {
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


