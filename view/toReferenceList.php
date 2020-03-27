<?php
require '../model/toReference.php';
//$aircraftMovementService=new aircraftMovementService();
//$stds=$aircraftMovementService->getAircrafts();
?>

<script type="text/javascript">
$(function () {
    $("#list").jqGrid({
        url: "../ajax/toReferenceListAjax.php",
        datatype: "xml",
        mtype: "GET",
        colNames: ["To","Cc","Audit Date","Audit Reference Number","Scope Number","Department","Section","Unit","Objective","Assignment Strategy","Deliverables","Report Distribution","Overview Audit Cover"],
        colModel: [
            {name:'tor_to', formatter:'showlink', formatoptions:{baseLinkUrl:'toReferenceView.php'},width: 80},
          { name: "tor_cc", width: 80 },
            { name: "audit_date", width: 80 },
            { name: "audit_ref_num", width: 80 },
            { name: "scp_number", width: 80 },
            { name: "dept_id", width: 80 },
            { name: "section_id", width: 80 },
            { name: "unit_id", width: 80 },
            { name: "objective", width: 80 },
            { name: "assignm_strategy", width: 80 },
            { name: "deliverables", width: 80 },
            { name: "report_dist", width: 80 },
            { name: "overview_audit_cov", width: 80 },
        ],
        pager: "#pager",
        rowNum: 30,
        rowList: [10, 20, 30, 50],
        sortname: "tor_to",
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
    <h3 class="panel-title">Terms of References</h3>
  </div>
  <div class="panel-body">
      <a href="toReferenceAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
<br>
<br>

<table id="list" class="table-condensed table-striped table-hover"  height="100%" width="640px"><tr><td></td></tr></table> 
    <div id="pager"></div> 

</div>
</div>
</div>
</div>
    
    <?php include '../include/footer.php'; ?>