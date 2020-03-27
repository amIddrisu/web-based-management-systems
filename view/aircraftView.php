<?php
require '../service/aircraftService.php';
$aircraftService = new aircraftService();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $aircraft = $aircraftService->getAircraft($id);
}
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title"> <b>AIRCRAFT DETAILS</b></h3></div>
<div class="panel-body">
                <div>
<a href="aircraftList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;LIST</a>&nbsp;&nbsp;
    <a href="aircraftEdit.php?id=<?php echo  $aircraft->id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;EDIT</a>
</div>&nbsp;&nbsp;
<table id="table1" class="table-condensed table-responsive table-bordered grid">
       
<tr>
    <th>Aircraft Registration:</th><td><a href="aircraftEdit.php?id=<?php echo $aircraft->id; ?>"> <?php echo "$aircraft->name"; ?></a></td>
</tr>
<tr>
<th>Aircraft Type:</th><td><?php echo "$aircraft->aircrafttype"; ?></td>
</tr>
<tr>
<th>UOM:</th><td><?php echo "$aircraft->uom" ;?></td>
</tr>
<tr>
<th>Weight:</th><td><?php echo "$aircraft->weight"; ?></td>
</tr>
<tr>
<th>Helicopter:</th><td><?php if ($aircraft->helicopter==1) {
			echo 'Helicopter';
		}else {echo 'N/A';} ?></td>
</tr>
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


