<?php
require_once '../model/waypoint.php';
?>

<script type="text/javascript">
$(function () {
    $("#list").jqGrid({
        url: "../ajax/waypointListAjax.php",
        datatype: "xml",
        mtype: "GET",
        colNames: ["Waypoint Name", "Boundary", "Latitude", "Longitude","Upper/Lower"],
        colModel: [
            {name:'name', formatter:'showlink', formatoptions:{baseLinkUrl:'waypointEdit.php'},width: 80},
            { name: "boundary", width: 80 },
            { name: "lat", width: 80 },
            { name: "longi", width: 80 },
            { name: "way_type", width: 80 }
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
    <h3 class="panel-title">WAYPOINT LIST</h3>
  </div>
  <div class="panel-body">
      <a href="waypointAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;ADD&nbsp;&nbsp;&nbsp;</a>
<br>
<br>

<table id="list" class="table-condensed table-striped table-hover"><tr><td></td></tr></table> 
    <div id="pager"></div> 

</div>
</div>
</div>
</div>
    
    <?php include '../include/footer.php'; ?>