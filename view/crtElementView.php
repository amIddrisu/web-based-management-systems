<?php
require '../model/crtElement.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
    $crtElement = new CrtElement();
if (isset($_GET['id'])) {
$id=$_GET['id'];
$crtElement=$crtElement->getCrtElement($id);
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title"> <b>Details of Critical Element</b></h3></div>
        <div class="panel-body">
            <div>
                <a href="crtElementAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
                <a href="crtElementList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
                <a href="crtElementEdit.php?id=<?php echo $crtElement->id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;

                <a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete?');" href="crtElementDelete.php?id=<?php echo $crtElement->id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
            </div>&nbsp;&nbsp;
            <table id="table1" class="table-condensed table-responsive table-bordered grid">
                <tr>
                    <th>Critical Area</th><td> <?php echo "$crtElement->crt_area"; ?></td>
                </tr>
                <tr>
                    <th>Speciality</th><td><?php echo "$crtElement->speciality"; ?></td>
                </tr>
                <tr>
                    <th>Description</th><td><?php echo "$crtElement->description"; ?></td>
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




