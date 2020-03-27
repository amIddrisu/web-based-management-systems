<?php
require '../model/section.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
    $sectionService = new Section();
if (isset($_GET['id'])) {
$id=$_GET['id'];
$section = $sectionService->getSection($id);
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title"> <b>Section Details</b></h3></div>
        <div class="panel-body">
            <div>
                <a href="sectionAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add&nbsp;&nbsp;&nbsp;</a>
                <a href="sectionList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List</a>&nbsp;&nbsp;
                <a href="sectionEdit.php?id=<?php echo $section->name; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a>&nbsp;&nbsp;

<a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete?');" href="sectionDelete.php?id=<?php echo $section->id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
            </div>&nbsp;&nbsp;
            <table id="table1" class="table-condensed table-responsive table-bordered grid">

<tr>
<th>Name</th><td><a href="sectionEdit.php?id=<?php echo $section->id; ?>"> <?php echo "$section->name"; ?></a></td>
</tr>
<tr>
<th>Department</th><td><?php echo "$section->dept_id"; ?></td>
</tr>
              
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




