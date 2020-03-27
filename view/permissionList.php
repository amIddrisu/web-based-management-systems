<?php
require '../model/permission.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$permission = new permission();
$stds = $permission->getPermissions();
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
    });
</script>
<div class="container-fluid">
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="panel panel-info">
            <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
                <h3 class="panel-title">PERMISSIONS</h3>
            </div>
            <div class="panel-body">
 <div>
     <a href="mpList.php" title="Manage Permission"><span class="glyphicon glyphicon-lock"></span>&nbsp;MANAGE PERMISSION</a>&nbsp;&nbsp;</div>&nbsp;&nbsp;
                <table id="table_id" class="table-condensed table-striped" width="25%">

                    <thead>
                        <tr>
                            <th>Description</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ((!empty($stds))) {
                            foreach ($stds as $key => $value) {
                                $permission = $stds [$key];
                                ?>
                                <tr>

                                    <td><?php echo $permission->perm_desc; ?></td>

                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<?php include '../include/footer.php'; ?>