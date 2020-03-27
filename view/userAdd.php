<?php
require '../controller/userAddController.php';
?>
<script type="text/javascript">

$(document).ready(function(){

	$('#username').css('background-color','#fbf3ba');	
	$('#password').css('background-color','#fbf3ba');	
	$('#firstname').css('background-color','#fbf3ba');	
	$('#lastname').css('background-color','#fbf3ba');
	$('#email').css('background-color','#fbf3ba');	
	$('#status').css('background-color','#fbf3ba');	
        $('#role_id').css('background-color','#fbf3ba');
		
	
});

</script>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<div class="panel panel-info">
 <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
    <h3 class="panel-title">ADD USER</h3>
		</div>
<div class="panel-body">
<?php 
if(empty($res->ERROR_MSG)){}  else {
echo '<div class="alert alert-danger">';
echo '<span>'.$res->ERROR_MSG.'</span>';  
echo '</div>';
}
 ?>
 
<form id="form1" method="post" action="userAdd.php" enctype="multipart/form-data">
<table class="table-condensed">
<tr>
    <td>
        <a href="userList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span></a>&nbsp;&nbsp;List
    </td>
</tr>
<tr>
<th>Username</th>
<td><input name="username" type="text" id="username" class="form-control input-sm" /></td>
</tr>
<tr>
<th>Password</th>
<td><input name="password" type="password" id="password" class="form-control input-sm"/></td>
</tr>
<tr>
<th>First Name</th>
<td><input name="firstname" type="text" id="firstname" class="form-control input-sm" /></td>
</tr>
<tr>
<th>Last Name</th>
<td><input name="lastname" type="text" id="lastname" class="form-control input-sm"/></td>
</tr>
<tr>
 <th>Role</th>
 <td><select name="role_id" type="text" placeholder="Roles" class="form-control input-sm" id="role_id">
            <option value="">Select Role</option>
            <?php  $userService->showUserRoleOptions(); ?>        
    </select></td>
</tr>
<tr>
<th>Phone</th>
<td><input name="phone" type="text" class="form-control"/></td>
</tr>
<tr>
<th>Address</th>
<td><textarea name="address" rows="4" cols="50" class="form-control input-sm"></textarea></td>
</tr>
<tr>
<th>Email</th>
<td><input id="email" name="email" type="text" class="form-control input-sm" /></td>
</tr>
<tr>
<th>Status</th>
<td><input name="status" type="checkbox" checked="checked" id="status"/></td>
</tr>
<tr>
<th>Photo</th>
<td>
 <input type="file" name="photo"/>
</td>
</tr>

<tr>
    <td>
</td>
<td><button type="submit" class="btn btn-info btn-sm" style="background-color: #428bca" name="submit"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save</button>
					<button type="reset" class="btn btn-info btn-sm" style="background-color: #428bca" name="reset"><span class="glyphicon glyphicon-repeat"></span>&nbsp;Reset</button>
					<button type="cancel"  class="btn btn-info btn-sm" style="background-color: #428bca" name="cancel"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Close</button>
				</td>

</tr>
</table>

</form>
</div>
</div>
</div>
<?php 
require '../include/footer.php';
?>