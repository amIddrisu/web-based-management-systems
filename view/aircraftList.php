<?php
require '../service/aircraftService.php';
//$aircraftService=new aircraftService();
//$stds=$aircraftService->getAircrafts();
?>

<script type="text/javascript">
$(function () {
    $("#list").jqGrid({
        url: "../ajax/aircraftListAjax.php",
        datatype: "xml",
        mtype: "GET",
        colNames: ["Name", "Aircraft Type", "Weight", "Helicopter"],
        colModel: [
            {name:'name', formatter:'showlink', formatoptions:{baseLinkUrl:'aircraftEdit.php'},width: 80},
            { name: "aircrafttype", width: 80 },
            { name: "weight", width: 80, align: "left" },
            { name: "helicopter", width: 80, align: "left" }
        ],
        pager: "#pager",
        rowNum: 30,
        rowList: [10, 20, 30, 50],
        sortname: "name",
        sortorder: "desc",
        viewrecords: true,
        gridview: true,
        autoencode: true
        
    });
   var DataGrid = jQuery('#list');
   //sets the grid size initially
 DataGrid.jqGrid('setGridWidth',800); 
 DataGrid.jqGrid('setGridHeight',640);

 //handles the grid resize on window resize
 $(window).resize(function () { DataGrid.jqGrid('setGridWidth', 800); });
 
 DataGrid.jqGrid('navGrid', '#pager', { edit: false, add: false, del: false, search: true,searchtext: "Search"});  
   
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

<table id="list" class="table-condensed table-striped table-hover"  height="100%" width="640px"><tr><td></td></tr></table> 
    <div id="pager"></div> 

</div>
</div>
</div>
</div>
    
    <?php include '../include/footer.php'; ?>