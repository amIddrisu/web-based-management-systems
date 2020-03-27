<?php
require '../service/userService.php';
$userService=new UserService();
if($_GET['id']){
$id=$_GET['id'];
$user=$userService->getUser($id);
}else{
    redirect("userList.php");
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
           <h3 class="panel-title"> <b>USER DETAILS</b></h3></div>
<div class="panel-body">
     <?php if ('Administrator' === $_SESSION['rolename']) { ?>
                <div>
<a href="userList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;LIST</a>&nbsp;&nbsp;
 <a href="userAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;ADD&nbsp;&nbsp;&nbsp;</a>
    <a href="userEdit.php?id=<?php echo  $user->user_id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;EDIT</a>&nbsp;&nbsp;
    <a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete');" href="userDeleted=<?php echo $user->user_id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;DELETE</a>
</div><?php } ?>
    &nbsp;&nbsp;

<table id="table1" class="table-condensed table-responsive table-bordered grid">
<tr><th>Photo</th><td><img src="<?php echo '../images/thumbs/'.$user->photo;?>" height="100" ></img></td></tr>	
<tr>
<th>Full Name:</th><td><a href="userEdit.php?id=<?php echo $user->user_id; ?>"> <?php echo "$user->firstname".'  '."$user->lastname";?></a></td>
</tr>
<tr>
<th>First Name:</th><td><?php echo $user->firstname; ?></td>
</tr>
<tr>
<th>Last Name:</th><td><?php echo $user->lastname;?></td>
</tr>
<tr>
<th>Phone:</th><td><?php echo $user->phone; ?></td>
</tr>
<tr>
<th>Email:</th><td><?php echo $user->email; ?></td>
</tr>
<tr>
<th>Role:</th><td><?php $role= $userService->getRole( $user->user_id); echo $role['name'];  ?> </td>
</tr>
<tr>
<th>Status:</th><td><?php if ($user->status==1) {
			echo 'Active';
		}else {echo 'Inactive';} ?></td>
</tr>
<tr>
<td><a href="userEdit.php?id=<?php echo  $user->user_id; ?>"> EDIT</a></td>
<td><?php if ('Administrator' === $_SESSION['rolename']) { ?><a href="userList.php"> LIST</a><?php } ?></td>
</tr>
</table>
</div>
<?php 
require '../include/footer.php';
?>

