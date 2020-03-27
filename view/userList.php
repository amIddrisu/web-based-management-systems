<?php
require '../controller/userListController.php';
?>
<script type="text/javascript">
    $(document).ready(function() {
    $('#table_id').dataTable({
    "dom": 'T<"clear">lfrtip',
            "tableTools": {
            "sSwfPath": "swf/copy_csv_xls_pdf.swf"
            },
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0]}]

    });
            // Remove Class For Sorting From the Table Header Select All Chceckbox 
            $("#td_select_all").removeClass("sorting_asc");
            // Action On Select All Checkbox	

            //select All Checkboxes to send those to Delete
            $("#selectall").on("click", function() {

    if ($("#selectall").prop("checked")) {
    $('.chk_del_row').prop('checked', true)
    } else {
    $(".chk_del_row").prop("checked", false);
    }
    });
    
    $(".clsDeleteLink").on("click",function(){
           if( confirmSubmit('Are you sure you want to delete all')){
		 $("#maskActionForm").submit();
                     }else{
                       // return false;
                     }				
			// return false;
 	}) ;	
	/////////////////
    });</script>
<div class="container-fluid">
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="panel panel-info">
            <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
                <h3 class="panel-title">USER LIST</h3>
            </div>
            <div class="panel-body">
                <a href="userAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;ADD&nbsp;&nbsp;&nbsp;</a>
                <a href="#" style="text-decoration:none;" class="clsDeleteLink"><span class="glyphicon glyphicon-minus"></span>&nbsp;Delete All</a>


                <br>
                <br>

                <form method="post" id="maskActionForm" action="userDelete.php">


                    <table id="table_id" class="table-condensed table-striped table-hover" width="100%">

                        <thead>   
                            <tr><td data-bSortable="false" id="td_select_all"><input type="checkbox" name="selectall" id="selectall"  /></td>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Photo</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>

                        </thead>
                        <tbody>

                            <?php
                            if ((!empty($stds))) {
                                foreach ($stds as $key => $value) {
                                    $user = $stds [$key];
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" id="chk_del_<?php echo $user->user_id; ?>" name="checkbox[]" class="chk_del_row" value="<?php echo $user->user_id; ?>" /></td>
                                        <td><a href="userView.php?id=<?php echo $user->user_id; ?>"> <?php echo $user->username; ?></a></td>
                                        <td><?php echo $user->firstname; ?></td>
                                        <td><?php echo $user->lastname; ?></td>
                                        <td><?php echo $user->phone; ?></td>
                                        <td><?php echo $user->email; ?></td>
                                        <td><?php $role = $userService->getRole($user->user_id);
                            echo $role['name']; ?></td>
                                        <td><?php
                                            if ($user->status == 1) {
                                                //$biconOk='span class="glyphicon glyphicon-ok-circle"></span> ';

                                                echo "<a href='userList.php?sid=$user->status&id=$user->user_id'>"
                                                . '<span class="glyphicon glyphicon-ok-circle"></span> Active</a>';
                                            } else {

                                                echo "<a class='alert-danger' href='userList.php?sid=$user->status&id=$user->user_id'>"
                                                . '<span class="glyphicon glyphicon-ban-circle" ></span> Inactive</a>';
                                            }
                                            ?></td>

                                        <td><img src="<?php echo '../images/thumbs/' . $user->photo; ?>" height="50" ></img></td>
                                        <td><a href="userEdit.php?id=<?php echo $user->user_id; ?>">  <span class="glyphicon glyphicon-pencil"></span></a></td>
                                        <td><a href="#" data-href="userDelete.php?id=<?php echo $user->user_id; ?>" data-toggle="modal" data-target="#confirm-delete-new"> <span class="glyphicon glyphicon-trash"></span></a></td>  
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
    <!--Modal view page for confirming delete-->
    <div class="modal fade" id="confirm-delete-new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog"  id="confirm-delete-new-modal">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #a94442"><span class="glyphicon glyphicon-warning-sign"></span> Confirm Delete</h4>
                </div>

                <div class="modal-body">
                    <p>Do you want to proceed?</p>
                    <p style="color: #a94442"><em><b>Your action is irreversible.</b></em></p>
                    <p class="debug-url"></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger danger" style="background-color: #428bca; color:#ffffff">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <script>
                $('#confirm-delete-new').on('show.bs.modal', function(e) {
        $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
                // $('.debug-url').html('Delete URL: <strong>' + $(this).find('.danger').attr('href') + '</strong>');
        })
    </script>
</div>
<?php include '../include/footer.php'; ?>