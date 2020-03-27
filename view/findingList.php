<?php
require '../service/findingService.php';
//$findingsService = new FindingsService();
//$stds=$findingsService->getFindingss();
?>

<script type="text/javascript">
$(function () {
    $("#list").jqGrid({
        url: "../ajax/findingListAjax.php",
        datatype: "xml",
        mtype: "GET",
        colNames: ["Finding Number", "Protocol Number", "Audit Reference Number", "Description", "Recommendation", "Evidence"],
        colModel: [
            {name:'finding_num', formatter:'showlink', formatoptions:{baseLinkUrl:'findingView.php'},width: 80},
            { name: "pro_number", width: 80 },
            { name: "audit_ref_num", width: 80, align: "left" },
            { name: "description", width: 80, align: "left" },
            { name: "recommendation", width: 80, align: "left" },
            { name: "evidence", width: 80, align: "left" }
        ],
        pager: "#pager",
        rowNum: 30,
        rowList: [10, 20, 30, 50],
        sortname: "finding_num",
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
    <h3 class="panel-title">Findings</h3>
  </div>
  <div class="panel-body">
<a href="findingAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
<br>
<br>

<table id="list" class="table-condensed table-striped table-hover"  height="100%" width="640px"><tr><td></td></tr></table> 
    <div id="pager"></div> 

</div>
</div>
</div>
</div>
    
    <?php include '../include/footer.php'; ?>