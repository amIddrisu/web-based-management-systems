<?php
require '../controller/exportController.php';

$itemNames=array('Aircraft','Airport','FIR','Operator','Route','Waypoint');

?>
<script type="text/javascript">
$(document).ready(function(){

		 //Dates
$("#startDate").datepicker();
$("#endDate").datepicker();
    
                        
});

</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #428bca; color:#ffffff">
            <h3 class="panel-title"> <b>IMPORT</b></h3></div>
<div class="panel-body">
                &nbsp;&nbsp;
                <?php 
if(empty($ERROR_MSG)){

//$SUCCESS_MSG
if(empty($SUCCESS_MSG)){}  else {
echo '<div  class="alert alert-success" role="alert">';
echo '<span><font  color="green" >'.$SUCCESS_MSG.'</font></span>';  
echo '</div>';
}

}  else {
echo '<div class="alert alert-danger">';
echo '<span><font  color="red" >'.$ERROR_MSG.'</font></span>';  
echo '</div>';
}


 ?>
                       <form  id="form1" name="form1" method="post" action="exportData.php"  enctype="multipart/form-data">
<table id="table1" name="table1" class="table-condensed">
 
    <tr>
     <th>Select an Item for Import </th>
        <td>
              <select name="moduleName" >
                <option value="none"> --- Select an Item --- </option>
                <?php 
//			 foreach($itemNames as $value)
//					{			 
//						echo '<option value="'.$value.'">'.$value.'</option>';
//					}
                echo '<option value="'.$itemNames[2].'">'.$itemNames[2].'</option>';
				?>
            </select>
        </td>
    </tr>
    <tr>
    <th>Date</th>
        <td>
            Start Date: <input type="text" name="startDate" id="startDate" /> &nbsp; End Date: <input type="text" name="endDate" id="endDate"/>
        </td>
    </tr>
    <tr><td></td>
        <td>
 
                <input type="submit"  name="doExport" value="Export"/>
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


