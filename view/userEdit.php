<?php
require '../controller/userEditController.php';
?>
<script type="text/javascript">

    $(document).ready(function () {

        $('#username').css('background-color', '#fbf3ba');
        $('#password').css('background-color', '#fbf3ba');
        $('#firstname').css('background-color', '#fbf3ba');
        $('#lastname').css('background-color', '#fbf3ba');
        $('#email').css('background-color', '#fbf3ba');
        $('#status').css('background-color', '#fbf3ba');
        $('#role_id').css('background-color', '#fbf3ba');
    });

</script>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="panel panel-info">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title">EDIT USER</h3>
        </div>
        <div class="panel-body">
            <?php
            if (empty($res->ERROR_MSG)) {
                
            } else {
                echo '<div class="alert alert-danger">';
                echo '<span>' . $res->ERROR_MSG . '</span>';
                echo '</div>';
            }
            ?>

            <form id="form1" method="post" action="userEdit.php" enctype="multipart/form-data">
                <table class="table-condensed">
                     <?php if ('Administrator' === $_SESSION['rolename']) { ?>
                    <tr>
                        <td>
                            <a href="userList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;LIST</a>&nbsp;&nbsp;

                        </td>
                    </tr>
                    <?php } ?> 
                    <tr><th>Photo</th><td><img src="<?php echo '../images/thumbs/' . $user->photo; ?>" height="100" ></img></td></tr>	

                    <tr>
                        <th>Username</th>
                        <td><input name="username" type="text" id="username" class="form-control input-sm" value="<?php echo $user->username; ?>"/></td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td><input name="password" type="password" id="password" class="form-control input-sm" value="<?php echo $user->password; ?>"/></td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td><input name="firstname" type="text" id="firstname" class="form-control input-sm" value="<?php echo $user->firstname; ?>"/></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><input name="lastname" type="text" id="lastname" class="form-control input-sm" value="<?php echo $user->lastname; ?>"/></td>
                    </tr>
                    <?php if ('Administrator' === $_SESSION['rolename']) { ?>
                        <tr>
                            <th>Role</th>
                            <td><select name="role_id" type="text" placeholder="Roles" class="form-control input-sm" id="role_id">
                                    <option value="<?php echo $user->role_id; ?>"> <?php $role = $userService->getRole($user->user_id);
                    echo $role['name'];
                        ?></option>

    <?php $userService->showUserRoleOptions(); ?>        
                                </select></td>
                        </tr>
<?php } else { ?> 
                        <tr style="display:none;">
                            <th>Role</th>
                            <td><select name="role_id" type="text" placeholder="Roles" class="form-control input-sm" id="role_id">
                                    <option value="<?php echo $user->role_id; ?>"> <?php $role = $userService->getRole($user->user_id);
                                    echo $role['name'];
                                    ?></option>

    <?php $userService->showUserRoleOptions(); ?>        
                                </select></td>
                        </tr>

<?php } ?> 
                    <tr>
                        <th>Phone</th>
                        <td><input name="phone" type="text" class="form-control" value="<?php echo $user->phone; ?>"/></td>
                    <tr>
                        <th>Address</th>
                        <td><textarea name="address" rows="4" cols="50" class="form-control input-sm" value="<?php echo $user->address; ?>"/></textarea></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input id="email" name="email" type="text" class="form-control input-sm" value="<?php echo $user->email; ?>"/></td>
                    </tr>
                    <?php if ('Administrator' === $_SESSION['rolename']) { ?>
                        <tr>
                            <th>Status</th>
                            <td><input name="status" id="status" type="checkbox" checked="<?php
                                       if ($user->status == 1) {
                                           echo '"checked"';
                                       }
                                       ?>  />
                                       </td>
                                       </tr>
                                       <tr>
                                       <th>Photo</th> 
                                       <td><input name="photo" type="file" /></td>
                        </tr>
                    <?php } else { ?> 
                         <tr style="display:none;">
                            <th>Status</th>
                            <td><input name="status" id="status" type="checkbox" checked="
                                <?php
                                       if ($user->status == 1) {
                                           echo '"checked"';
                                       }
                                       ?>  />
                                       </td>
                                       </tr>
                                       <tr>
                                       <th>Photo</th> 
                                       <td> <input name="photo" type="file" /></td>
                        </tr>

                            <?php } ?> 
                    <tr>
                        <td><input name="user_id" type="hidden" value="<?php echo $user->user_id; ?>" />
                        </td>
                        <td><button type="submit" class="btn btn-info btn-sm" style="background-color: #428bca" name="submit"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save</button>
                           
                            <button type="cancel" class="btn btn-info btn-sm" style="background-color: #428bca" name="cancel"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Close</button>
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


