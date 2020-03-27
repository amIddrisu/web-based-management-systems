<?php
require '../model/page.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
    $page=new page();
if (isset($_GET['id'])) {
$id=$_GET['id'];
$page=$page->getPage($id);
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title"> <b>PAGE DETAILS</b></h3></div>
        <div class="panel-body">
            <div>
                <a href="pageAdd.php" style="text-decoration:none;"><span class="glyphicon glyphicon-plus"></span>&nbsp;ADD&nbsp;&nbsp;&nbsp;</a>
                <a href="pageList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;LIST</a>&nbsp;&nbsp;
                <a href="pageEdit.php?id=<?php echo $page->page_id; ?>" title="Edit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;EDIT</a>&nbsp;&nbsp;

                <a title="Delete" onclick="return confirmSubmit('Are you sure you want to delete');" href="pageDelete.php?id=<?php echo $page->page_id; ?>" ><span class="glyphicon glyphicon-trash"></span>&nbsp;DELETE</a>
            </div>&nbsp;&nbsp;
            <table id="table1" class="table-condensed table-responsive table-bordered grid">
                <tr>
                    <th>Description:</th><td><a href="pageEdit.php?id=<?php echo $page->page_id; ?>"> <?php echo "$page->page_desc"; ?></a></td>
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




