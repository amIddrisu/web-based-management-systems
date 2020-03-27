<?php
require_once  '../service/scopeService.php';
require_once  '../validation/scopeValidation.php';
        
        $res = new ScopeValidation();
         $scopeService = new ScopeService();
        
        //create an aircraft movement instance
        $scope = new Scope();
        
        //$aircraft->uom='Tonnes';
        
        //checking to make sure the user really submitted the form
        if(isset($_POST['submit'])){
            
            //populating the new object with values entered by the user 
            $scope->scp_number = $res->valInput($_POST['scp_number']);
            $scope->description = $res->valInput($_POST['description']);
            $scope->dept_id = $res->valInput($_POST['dept_id']);
            $scope->section_id = $res->valInput($_POST['section_id']);
            $scope->unit_id = $res->valInput($_POST['unit_id']);
     
            
            
            
//            if(isset($_POST['helicopter'])){
//                            $aircraft->helicopter=1;
//                        }else{
//                            $aircraft->helicopter=0;
//                        }
//                        
//                        
            //making sure object passes validation
            if($res->validate($scope)){
                
                //call the add method in service
               
                $res->ERROR_MSG=$res->ERROR_MSG.$scopeService->add($scope);
                $url = "../view/scopeList.php?id=$scope->id";
                redirect($url);
              }
             
        }
?>
