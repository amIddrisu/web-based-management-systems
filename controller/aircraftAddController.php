 <?php
require_once  '../service/aircraftService.php';
require_once  '../validation/aircraftValidation.php';
        $res = new aircraftValidation();
        $aircraft = new aircraft();
        $aircraft->uom='Tonnes';
        if(isset($_POST['submit'])){
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
                $res->ERROR_MSG=$res->ERROR_MSG.$aircraftService->add($aircraft);
                $url = "../view/aircraftView.php?id=$aircraft->id";
                redirect($url);
              }
             
        }
?>
