<?php
require '../model/role_perm.php';
require '../validation/role_permValidation.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
if(isset($_POST['cancel'])){redirect("mpList.php");}
$res = new role_permValidation();
$role_perm = new role_perm();
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $role_perm->id = $id;
}

if (isset($_POST['submit'])) {
    
    $role_perm->id = $_POST['id'];
    $role_perm->role_id = $_POST['role_id'];
    $role_perm->page_id = $_POST['page_id'];
  //  $role_perm->perm_id = $_POST['permCheckboxes'];

    if ($res->validate($role_perm)) {
        //insert
        if (!is_null($role_perm->id)) {
            $role_perm->addRolePagePerm($role_perm->id);
        }
    }
}
?>
<script type="text/javascript">

    $(document).ready(function() {

        $('#page_desc').css('background-color', '#fbf3ba');

        //select All Checkboxes 
        $("#selectall").on("click", function() {

            if ($("#selectall").prop("checked")) {
                $('.input-label').prop('checked', true)
            } else {
                $(".input-label").prop("checked", false);
            }
        });

    });

</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="panel panel-info">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title">MANAGE PERMISSIONS</h3>
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
            <form id="form1" method="post" action="mp.php" enctype="multipart/form-data">
                <table class="table-condensed">
                    <tr>
                        <th>Role</th>
                        <td><select name="role_id" type="text" placeholder="Roles" class="form-control input-sm" id="role_id">
                                <?php
                                if (isset($_GET['id'])) {
                                    $role_perm->id = $_GET['id'];
                                    $role_perm->updateUserRoleOptions($role_perm->id);
                                } else {
                                    $role_perm->showUserRoleOptions();
                                }
                                ?>        
                            </select></td>
                    </tr>
                    <tr>
                        <th>Page</th>
                        <td><select name="page_id" type="text" placeholder="Pages" class="form-control input-sm" id="page_id">
                                <?php
                                if (isset($_GET['id'])) {
                                   $role_perm->id = $_GET['id'];
                                    $role_perm->updatePagesOptions( $role_perm->id);
                                } else {
                                    $role_perm->showPagesOptions();
                                }
                                ?>         
                            </select></td>
                    </tr>
                    <tr>
                        <th>Permissions</th>
                        <td>
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border input-sm"><b>Select All</b>
                                    <input type="checkbox" name="selectall" id="selectall" /></legend>
                                <div class="control-group">

                                    <label class="control-label input-label" for="permCheckboxes[]">
                                        <?php
                                        if (isset($_GET['id'])) {
                                            
                                            $role_perm->id = $_GET['id'];
                                            $role_perm->updatePermissionsCheckboxes($role_perm->id);
                                        } else {
                                            $role_perm->showPermissionsCheckboxes();
                                        }

                                        ?>    
                                    </label>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $role_perm->id; ?>" />
                        </td>
                        <td><button type="submit" class="btn btn-info btn-sm" style="background-color: #428bca" name="submit"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save</button>
                            <button type="reset" class="btn btn-info btn-sm" style="background-color: #428bca" name="reset"><span class="glyphicon glyphicon-repeat"></span>&nbsp;Reset</button>
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