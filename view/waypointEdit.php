<?php
require '../model/waypoint.php';
require '../validation/waypointValidation.php';
if (isset($_POST['cancel'])) {
    redirect('waypointList.php');
}
$res = new waypointValidation();
$waypoint = new waypoint();

if (isset($_GET['id'])) {

    $waypoint = $waypoint->getWaypoint($_GET['id']);
}

if (isset($_POST['submit'])) {
    $waypoint->id = $_POST['id'];
    $waypoint->name = $res->valInput($_POST['name']);
    $waypoint->lat = $res->valInput($_POST['lat']);
    $waypoint->longi = $res->valInput($_POST['longi']);


    if (isset($_POST['way_type'])) {
        if ($_POST['way_type'] === 1 || $_POST['way_type'] == 1) {
            $waypoint->way_type = 1;
        }
    }
    if (isset($_POST['boundary'])) {
        if ($_POST['boundary'] === 1 || $_POST['boundary'] == 1) {
            $waypoint->boundary = 1;
        }
    }

    if ($res->validate($waypoint)) {
        //edit
        $res->ERROR_MSG=$res->ERROR_MSG.$waypoint->editWaypoint($waypoint);
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
            <h3 class="panel-title">EDIT WAYPOINT</h3>
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
            <form id="form1" method="post" action="waypointEdit.php" enctype="multipart/form-data">
                <table class="table-condensed">
                    <tr>
                        <td>
                            <a href="waypointList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; LIST</a>&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>Waypoint Name</th>
                        <td><input name="name" type="text" placeholder="Waypoin Name" class="form-control input-sm" id="name" value="<?php echo $waypoint->name; ?>" /></td>
                    </tr>
                    <tr>
                        <th>Boundary</th>
                        <td><input name="boundary" type="checkbox" <?php if ($waypoint->boundary === 1 || $waypoint->boundary == 1) {
                echo 'checked="checked"';
            }
            ?> placeholder="Boundary" class="form-control input-sm" id="boundary" value="1" /></td>
                    </tr>
                    <tr>
                        <th>Latitude</th>
                        <td><input name="lat" type="text" placeholder="Latitude" class="form-control input-sm" id="lat" value="<?php echo $waypoint->lat; ?>" /></td>
                    </tr>
                    <tr>
                        <th>Longitude</th>
                        <td><input name="longi" type="text" placeholder="Longitude" class="form-control input-sm" id="longi" value="<?php echo $waypoint->longi; ?>" /></td>
                    </tr>
                    <tr>
                        <th>Upper/Lower</th>
                        <td><input name="way_type" type="checkbox" <?php if ($waypoint->way_type === 1 || $waypoint->way_type == 1) {
                echo 'checked="checked"';
            }
            ?> placeholder="Upper/Lower" class="form-control input-sm" id="way_type" value="1" /></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="id" value="<?php echo $waypoint->id; ?>" />
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