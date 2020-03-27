<?php
require '../service/aircraftService.php';
//$aircraftService=new aircraftService();
//$stds=$aircraftService->getAircrafts();
?>

<script type="text/javascript">
$(function () {
    $("#list").jqGrid({
        url: "../ajax/newaircraftAjax.php",
        datatype: "xml",
        mtype: "GET",
        colNames: ["Name", "Aircraft Type", "Weight", "Helicopter"],
        colModel: [
            { name: "Name", width: 55 },
            { name: "Aircraft Type", width: 90 },
            { name: "Weight", width: 80, align: "right" },
            { name: "Helicopter", width: 80, align: "right" }
        ],
        pager: "#pager",
        rowNum: 10,
        rowList: [10, 20, 30],
        sortname: "name",
        sortorder: "desc",
        viewrecords: true,
        gridview: true,
        autoencode: true,
        caption: "Aircraft List"
    }); 
}); 
</script>
<div class="container-fluid">
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">AIRCRAFT LIST</h3>
  </div>
  <div class="panel-body">
<a href="aircraftAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;ADD&nbsp;&nbsp;&nbsp;</a>
<br>
<br>

<table id="list"><tr><td></td></tr></table> 
    <div id="pager"></div> 

</div>
</div>
</div>
</div>
    
    <?php include '../include/footer.php'; ?>