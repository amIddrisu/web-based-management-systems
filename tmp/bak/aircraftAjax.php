<?php
//require_once '../model/aircraft.php';
//require_once '../include/global.php';
//require_once '../util/uuid.php';
require_once '../service/aircraftService.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of aircraftAjax
 *
 * @author beshun
 */
$_index=NULL;
  $_index = ($_REQUEST['row'])?$_REQUEST['row']:NULL;
        $aircraftService=new aircraftService();
       $aircraft=New aircraft();
        $stds=array();
        $data=array('Name'=>$aircraft->name,'Aircraft Type'=>$aircraft->aircrafttype,'Weight'=>$aircraft->weight,'Helicopter'=>$aircraft->helicopter);
        $adata=array();
     $stds=$aircraftService->getAircraftList($_index);
     
     ///TODO build array for json
     if ((!empty($stds))) {
                            foreach ($stds as $key => $value) {
                                $aircraft = $stds [$key];
                               
                             // $data['id']= $aircraft->id;
                                   $data['Name']= $aircraft->name;
                                  $data['Aircraft Type']=$aircraft->aircrafttype;
                                    $data['Weight']=$aircraft->weight;
                                    if($aircraft->helicopter == 1) {
                                            $data['Helicopter']="YES";
                                        } else {
                                            $data['Helicopter']="N/A";
                                        }
                                        $adata[]=$data;
                            }
                           
   
     $txt=json_encode($adata);
     echo $txt;
  //   $myfile = fopen("../tmp/aircrafts.txt", "w") or die("Unable to open file!");
//fwrite($myfile, $txt);
//fclose($myfile);
     }
