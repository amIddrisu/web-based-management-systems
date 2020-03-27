<?php
require_once  '../service/protocolService.php';
require_once  '../validation/protocolValidation.php';
        
        $res = new ProtocolValidation();
         $protocolService = new ProtocolService();
        
        //create an aircraft movement instance
        $protocol = new Protocol();
        
        //$aircraft->uom='Tonnes';
        
        //checking to make sure the user really submitted the form
        if(isset($_POST['submit'])){
            
            //populating the new object with values entered by the user 
            $protocol->scp_number = $res->valInput($_POST['scp_number']);
            $protocol->pro_number = $res->valInput($_POST['pro_number']);
            $protocol->dept_id = $res->valInput($_POST['dept_id']);
            $protocol->section_id = $res->valInput($_POST['section_id']);
            $protocol->unit_id = $res->valInput($_POST['unit_id']);
            $protocol->pro_reference = $res->valInput($_POST['pro_reference']);
            $protocol->pro_question = $res->valInput($_POST['pro_question']);
           
            
            
            
//            if(isset($_POST['helicopter'])){
//                            $aircraft->helicopter=1;
//                        }else{
//                            $aircraft->helicopter=0;
//                        }
//                        
//                        
            //making sure object passes validation
            if($res->validate($protocol)){
                
                //call the add method in service
               
                $res->ERROR_MSG=$res->ERROR_MSG.$protocolService->add($protocol);
                $url = "../view/protocolList.php?id=$protocol->id";
                redirect($url);
              }
             
        }
?>
