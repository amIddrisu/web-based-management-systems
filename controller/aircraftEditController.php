<?php
require '../service/aircraftService.php';
require '../validation/aircraftValidation.php';	

$aircraftService=new aircraftService();
$res = new aircraftValidation();
$aircraft=new aircraft();
if (isset($_GET['id'])) {
	$aircraft->id=$_GET['id'];
	$aircraft=$aircraftService->getAircraft($aircraft->id);
}	

  if(isset($_POST['submit'])){
            $aircraft->id = $res->valInput($_POST['id']);
            $aircraft->name = $res->valInput($_POST['name']);
            $aircraft->aircrafttype = $res->valInput($_POST['aircrafttype']);
            $aircraft->uom = $res->valInput($_POST['uom']);
            $aircraft->weight = $res->valInput($_POST['weight']);
             if(isset($_POST['helicopter'])){
                            $aircraft->helicopter=1;
                        }else{
                            $aircraft->helicopter=0;
                        }
            if($res->validate($aircraft)){
                
                $aircraftService = new aircraftService();
                $res->ERROR_MSG=$res->ERROR_MSG.$aircraftService->edit($aircraft);
             
              }
             
        }
?>
