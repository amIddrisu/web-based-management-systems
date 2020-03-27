<?php
require '../service/protocolService.php';
$protocolService = new ProtocolService();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $protocol = $protocolService->getProtocol($id);
}
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title"> <b>Details of Protocol</b></h3></div>
<div class="panel-body">
                
                <div>
                    <a href="protocolAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
                    <a href="protocolList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
                    <a href="protocolEdit.php?id=<?php echo  $protocol->id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>
                    <a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete?');" href="protocolDelete.php?id=<?php echo $protocol->id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
                </div>&nbsp;&nbsp;
<table id="table1" class="table-condensed table-responsive table-bordered grid">
       
<tr>
<th>Scope Number</th><td><?php echo "$protocol->scp_number"; ?></a></td>
</tr>
<tr>
<th>Protocol Number</th><td><?php echo "$protocol->pro_number"; ?></td>
</tr>
<tr>
<th>Department</th><td><?php echo "$protocol->dept_id"; ?></td>
</tr>
<tr>
<th>Section</th><td><?php echo "$protocol->section_id"; ?></td>
</tr>
<tr>
<th>Unit</th><td><?php echo "$protocol->unit_id"; ?></td>
</tr>
<tr>
<th>Protocol Reference</th><td><?php echo "$protocol->pro_reference" ;?></td>
</tr>
<tr>
<th>Protocol Question</th><td><?php echo "$protocol->pro_question" ;?></td>
</tr>



<!--<tr>
<th>Helicopter:</th><td><?php // if ($protocol->helicopter==1) {
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


