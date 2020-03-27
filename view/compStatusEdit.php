<?php
require '../model/compStatus.php';
require '../validation/compStatusValidation.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
 if (isset($_POST['cancel'])) { redirect('compStatusList.php');}
$res = new CompStatusValidation();
$compStatus = new CompStatus();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $compStatus= $compStatus->getCompStatus($id);
}

if (isset($_POST['submit'])) {
    $compStatus->id = $res->valInput($_POST['id']);
    $compStatus->name = $res->valInput($_POST['name']);

    if ($res->validate($compStatus)) {
        //insert
        $compStatus->editCompStatus($compStatus);
    }
}
?>
<script type="text/javascript">

    $(document).ready(function() {

        $('#name').css('background-color', '#fbf3ba');

    });

</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="panel panel-info">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title">EDIT COMP STATUS</h3>
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
            <form id="form1" method="post" action="compStatusEdit.php" enctype="multipart/form-data">
                <table class="table-condensed">
                    <tr>
                        <td>
                            <a href="compStatusList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; LIST</a>&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><input name="name" type="text" placeholder="Name" class="form-control input-sm" id="name" value="<?php echo $compStatus->name; ?>" /></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="id" value="<?php echo $compStatus->compStatus_id; ?>" />
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