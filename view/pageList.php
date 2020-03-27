<?php
require '../model/page.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$page = new page();
$stds = $page->getPages();
?>
<script type="text/javascript">
$(document).ready( function () {
  $('#table_id').dataTable( {
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "swf/copy_csv_xls_pdf.swf"
        },
		"aoColumnDefs": [{ "bSortable": false, "aTargets": [0] }] 
		
    } );
	
	 // Remove Class For Sorting From the Table Header Select All Chceckbox 
	 $("#td_select_all").removeClass("sorting_asc");

	 // Action On Select All Checkbox	
	
	//select All Checkboxes to send those to Delete
	$("#selectall").on("click",function(){
			
			if($("#selectall").prop("checked")){	
				$('.chk_del_row').prop('checked', true)
			}else{
				$(".chk_del_row").prop("checked",false);
			}						
 	}) ;
	
	$(".clsDeleteLink").on("click",function(){
			 $("#maskActionForm").submit();				
			// return false;
 	}) ;	
	
	
	
} );
</script>
<div class="container-fluid">
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="panel panel-info">
            <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
                <h3 class="panel-title">PAGES</h3>
            </div>
            <div class="panel-body">
                <a href="pageAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;ADD&nbsp;&nbsp;&nbsp;</a>
                <a href="#" style="text-decoration:none;" class="clsDeleteLink"><span class="glyphicon glyphicon-minus"></span>&nbsp;Delete All</a>


                <br>
                <br>

                <form method="post" id="maskActionForm" action="pageDelete.php">

                    <table id="table_id" class="table-condensed table-striped" width="25%">

                        <thead>   
                            <tr><td data-bSortable="false" id="td_select_all"><input type="checkbox" name="selectall" id="selectall"  /></td>

                                <th>Page Name</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if ((!empty($stds))) {
                                foreach ($stds as $key => $value) {
                                    $page = $stds [$key];
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" id="chk_del_<?php echo $page->page_id; ?>" name="checkbox[]" class="chk_del_row" value="<?php echo $page->page_id; ?>" /></td>
                                        <td><a href="pageView.php?id=<?php echo $page->page_id; ?>"> <?php echo $page->page_desc;; ?></a></td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../include/footer.php'; ?>