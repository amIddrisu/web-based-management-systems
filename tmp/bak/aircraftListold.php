<?php
require '../service/aircraftService.php';
//$aircraftService=new aircraftService();
//$stds=$aircraftService->getAircrafts();
?>
<script type="text/javascript">
    

$(document).ready(function() {
    $('#table_id').dataTable( {
        "ajax": '../ajax/aircraftAjax.php?row=50'
    } );
} );
 
</script>
<div class="container-fluid">
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">AIRCRAFT LIST</h3>
  </div>
  <div class="panel-body">
<a href="aircraftAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;ADD&nbsp;&nbsp;&nbsp;</a>
<a href="#" style="text-decoration:none;"  class="clsDeleteLink"><span class="glyphicon glyphicon-minus"></span>&nbsp;Delete All</a>
<br>
<br>

<form method="post" id="maskActionForm" action="aircraftDelete.php">

<table id="table_id" class="table-condensed table-striped table-hover" width="100%">
 
 <thead>   
                            <th>Name</th>
                            <th>Aircraft Type</th>
                            
                            <th>Weight</th>
                            <th>Helicopter</th>

                           
                        </tr>
                    </thead>
                    
                </table>
                       <input type="hidden" name="id" value="null" id="id" />
</form>

</div>
</div>
</div>
    
    <?php include '../include/footer.php'; ?>