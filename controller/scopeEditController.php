<?php
require '../service/scopeService.php';
require '../validation/scopeValidation.php';	

//creating new aircraft movement instance
$scopeService=new ScopeService();
$res = new ScopeValidation();
$scope=new Scope();

//obtaining id 
if (isset($_GET['id'])) {
	$scope->id=$_GET['id'];
	$scope=$scopeService->getScope($scope->id);
}	


  //check if user submitted form
  if(isset($_POST['submit'])){
      
            //populating object with values entered by user
            $scope->scp_number = $res->valInput($_POST['scp_number']);
            $scope->id = $res->valInput($_POST['id']);
            $scope->description = $res->valInput($_POST['description']);
            $scope->dept_id = $res->valInput($_POST['dept_id']);
            $scope->section_id = $res->valInput($_POST['section_id']);
            $scope->unit_id = $res->valInput($_POST['unit_id']);
       
           
            
            
//            if(isset($_POST['helicopter'])){
//                            $scope->helicopter=1;
//                        }else{
//                            $scope->helicopter=0;
//                        }
            
            //check if object passes validation
            if($res->validate($scope)){
                
                
                //call edit method
                $scopeService = new ScopeService();
                $res->ERROR_MSG=$res->ERROR_MSG.$scopeService->edit($scope);
             
              }
             
        }
?>
