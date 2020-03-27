<?php
require '../service/scopeService.php';
//$scopesService = new ProtocolsService();
//$stds=$scopesService->getProtocolss();
?>

<script type="text/javascript">
$(function () {
    $("#list").jqGrid({
        url: "../ajax/scopeListAjax.php",
        datatype: "xml",
        mtype: "GET",
        colNames: ["Scope Number", "Description", "Department", "Section", "Unit"],
        colModel: [
            {name:'scp_number', formatter:'showlink', formatoptions:{baseLinkUrl:'scopeView.php'},width: 80},
            {name: "pro_number", width: 80 },
            {name: "dept_id", width: 80, align: "left" },
            {name: "section_id", width: 80, align: "left" },
            {name: "unit_id", width: 80, align: "left" }
      
        ],
        pager: "#pager",
        rowNum: 30,
        rowList: [10, 20, 30, 50],
        sortname: "scp_number",
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
    <h3 class="panel-title">Scopes</h3>
  </div>
  <div class="panel-body">
<a href="scopeAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
<br>
<br>

<table id="list" class="table-condensed table-striped table-hover"  height="100%" width="640px"><tr><td></td></tr></table> 
    <div id="pager"></div> 

</div>
</div>
</div>
</div>
    
    <?php include '../include/footer.php'; ?>