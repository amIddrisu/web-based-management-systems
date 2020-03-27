<?php
require_once  '../service/findingService.php';
require_once  '../validation/findingValidation.php';
        
        $res = new FindingValidation();
         $findingService = new FindingService();
        
        //create an aircraft movement instance
        $finding = new Finding();
        
        //$aircraft->uom='Tonnes';
        
        //checking to make sure the user really submitted the form
        if(isset($_POST['submit'])){
            
            //populating the new object with values entered by the user 
            $finding->finding_num = $res->valInput($_POST['finding_num']);
            $finding->pro_number = $res->valInput($_POST['pro_number']);
            $finding->audit_ref_num = $res->valInput($_POST['audit_ref_num']);
            $finding->description = $res->valInput($_POST['description']);
            $finding->recommendation = $res->valInput($_POST['recommendation']);
            $finding->evidence = $res->valInput($_POST['evidence']);
           
            
            
            
//            if(isset($_POST['helicopter'])){
//                            $aircraft->helicopter=1;
//                        }else{
//                            $aircraft->helicopter=0;
//                        }
//                        
//                        
            //making sure object passes validation
            if($res->validate($finding)){
                
                //call the add method in service
               
                $res->ERROR_MSG=$res->ERROR_MSG.$findingService->add($finding);
                $url = "../view/findingList.php?id=$finding->id";
                redirect($url);
              }
             
        }
?>
