<?php
require '../model/waypoint.php';
$waypoint = new waypoint();
$waypoint = $waypoint->getWaypoint($_GET['id']);
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title"> <b>WAYPOINT DETAILS</b></h3></div>
        <div class="panel-body">
            <div>
                <a href="waypointAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;ADD&nbsp;&nbsp;&nbsp;</a>
                <a href="waypointList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;LIST</a>&nbsp;&nbsp;
                <a href="waypointEdit.php?id=<?php echo $waypoint->id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;EDIT</a>&nbsp;&nbsp;

                <a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete');" href="waypointDelete.php?id=<?php echo $waypoint->id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;DELETE</a>
            </div>&nbsp;&nbsp;
            <table id="table1" class="table-condensed table-responsive table-bordered grid">
                <tr>
                    <th>Name:</th><td><a href="waypointEdit.php?id=<?php echo $waypoint->id; ?>"> <?php echo "$waypoint->name"; ?></a></td>
                </tr>
                <tr>
                    <th>Boundary:</th><td> <?php
                        if ($waypoint->boundary == 1) {
                            echo "YES";
                        } else {
                            echo "NO";
                        }
                        ?></td>
                </tr>
                <tr>
                    <th>Latitude:</th><td><?php echo "$waypoint->lat"; ?></td>
                </tr>
                <tr>
                    <th>Longitude:</th><td> <?php echo "$waypoint->longi"; ?></td>
                </tr>
                <tr>
                    <th>Upper/Lower:</th><td> <?php
                        if ($waypoint->way_type == 1) {
                            echo "UPPER";
                        } else {
                            echo "LOWER";
                        }
                        ?></td>
                </tr>

                <tr>
                <tr>
                </tr>
                <tr>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php
require '../include/footer.php';
?>




