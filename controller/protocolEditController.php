<?php
require '../service/protocolService.php';
require '../validation/protocolValidation.php';	

//creating new aircraft movement instance
$protocolService=new ProtocolService();
$res = new ProtocolValidation();
$protocol=new Protocol();

//obtaining id 
if (isset($_GET['id'])) {
	$protocol->id=$_GET['id'];
	$protocol=$protocolService->getProtocol($protocol->id);
}	


  //check if user submitted form
  if(isset($_POST['submit'])){
      
            //populating object with values entered by user
            $protocol->scp_number = $res->valInput($_POST['scp_number']);
            $protocol->id = $res->valInput($_POST['id']);
            $protocol->pro_number = $res->valInput($_POST['pro_number']);
            $protocol->dept_id = $res->valInput($_POST['dept_id']);
            $protocol->section_id = $res->valInput($_POST['section_id']);
            $protocol->unit_id = $res->valInput($_POST['unit_id']);
            $protocol->pro_reference = $res->valInput($_POST['pro_reference']);
             $protocol->pro_question = $res->valInput($_POST['pro_question']);
           
            
            
//            if(isset($_POST['helicopter'])){
//                            $protocol->helicopter=1;
//                        }else{
//                            $protocol->helicopter=0;
//                        }
            
            //check if object passes validation
            if($res->validate($protocol)){
                
                
                //call edit method
                $protocolService = new ProtocolService();
                $res->ERROR_MSG=$res->ERROR_MSG.$protocolService->edit($protocol);
             
              }
             
        }
?>
