<?php
require '../service/findingService.php';
require '../validation/findingValidation.php';	

//creating new aircraft movement instance
$findingService=new FindingService();
$res = new FindingValidation();
$finding=new Finding();

//obtaining id 
if (isset($_GET['id'])) {
	$finding->id=$_GET['id'];
	$finding=$findingService->getFinding($finding->id);
}	


  //check if user submitted form
  if(isset($_POST['submit'])){
      
            //populating object with values entered by user
            $finding->finding_num = $res->valInput($_POST['finding_num']);
            $finding->id = $res->valInput($_POST['id']);
            $finding->pro_number = $res->valInput($_POST['pro_number']);
            $finding->audit_ref_num = $res->valInput($_POST['audit_ref_num']);
            $finding->description = $res->valInput($_POST['description']);
            $finding->recommendation = $res->valInput($_POST['recommendation']);
            $finding->evidence = $res->valInput($_POST['evidence']);
           
            
            
//            if(isset($_POST['helicopter'])){
//                            $finding->helicopter=1;
//                        }else{
//                            $finding->helicopter=0;
//                        }
            
            //check if object passes validation
            if($res->validate($finding)){
                
                
                //call edit method
                $findingService = new FindingService();
                $res->ERROR_MSG=$res->ERROR_MSG.$findingService->edit($finding);
             
              }
             
        }
?>
