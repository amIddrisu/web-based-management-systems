<?php
require '../model/role.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
$role = new role();
$stds = $role->getRoles();
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
                <h3 class="panel-title">ROLES</h3>
            </div>
            <div class="panel-body">

                <table id="table_id" class="table-condensed table-striped" width="25%">

                    <thead>
                        <tr>
                            <th>Name</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ((!empty($stds))) {
                            foreach ($stds as $key => $value) {
                                $role = $stds [$key];
                                ?>
                                <tr>

                                    <td><?php echo $role->name; ?></td>

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