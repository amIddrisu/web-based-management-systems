<?php

require '../model/role_perm.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$role_perm = new role_perm();
$stds = $role_perm ->getRolePagePerms();
    
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
           if( confirmSubmit('Are you sure you want to delete all')){
		 $("#maskActionForm").submit();
                     }else{
                       // return false;
                     }				
			// return false;
 	}) ;	
	
	
	
} );
</script>
<div class="container-fluid">
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">MANAGE PERMISSIONS LIST</h3>
  </div>
  <div class="panel-body">
<a href="mp.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;ADD&nbsp;&nbsp;&nbsp;</a>
<a href="#" style="text-decoration:none;"  class="clsDeleteLink"><span class="glyphicon glyphicon-minus"></span>&nbsp;Delete All</a>


<br>
<br>

<form method="post" id="maskActionForm" action="../model/role_perm.php">

<table id="table_id" class="table-condensed table-striped" width="100%">
 
 <thead>   
	<tr><td data-bSortable="false" id="td_select_all"><input type="checkbox" name="selectall" id="selectall"  /></td>
		<th>Role</th>
		<th>Page</th>
                <th>Permissions</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
 </thead>
    <tbody>

<?php 
if((!empty($stds))){
foreach($stds as $key=>$value)
			{			 
				$role_perm=$stds [$key];
?>
	<tr>
		<td><input type="checkbox" id="chk_del_<?php echo $role_perm->id;?>" name="checkbox[]" class="chk_del_row" value="<?php echo $role_perm->id;?>" /></td>
                
                <td><a href="mp.php?id=<?php echo $role_perm->id;?>"><?php $role= $role_perm->getRole( $role_perm->role_id); echo $role['name'];  ?></a></td>
                <td><?php $page= $role_perm->getPage( $role_perm->page_id); echo $page['page_desc'];  ?></td>
		<td><?php echo $role_perm->perm_id;?></td>
		<td><a href="mp.php?id=<?php echo $role_perm->id;?>">  <span class="glyphicon glyphicon-pencil"></span></a></td>
        <td>
         <a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete');" href="mpDelete.php?id=<?php echo $role_perm->id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;DELETE</a>
        </td>
		
	</tr>
<?php 
}
}
?>
   </tbody>
</table>
            <input type="hidden" name="id" value="null" id="id" />
</form>

</div>
</div>
</div>
</div>

<?php include '../include/footer.php';?>