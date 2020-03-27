<?php

require_once 'commonService.php';
require_once '../model/fir.php';
require_once '../include/util.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of importService
 *
 * @author beshun
 */
class exportService {

    function exportService() {
        
    }
   public function exportFIR($activeSheet,$ERROR_MSG,$items){
       
       // $fir = new fir();
  $key=2;
        foreach ($items as $k => $value) {
      

               // $fir->aircraft_id = $item['id'];
                $tbl = "aircraft";
                $col = "id";
               
                //$fir->aircraft_id = NULL;
                $rowReg = getItem($tbl, $col,  $value['aircraft_id'] );
       
                if (!empty($rowReg)) {
                     $activeSheet->setCellValue('A'.$key, $rowReg['name']);
                }
           
               // $fir->arrdate = date("Y-m-d", strtotime($item['arrdate']));
                $activeSheet->setCellValue('B'.$key,date("Y-m-d", strtotime($value['arrdate'])));
            

                //$fir->ata = $item['ata'];
                 $activeSheet->setCellValue('C'.$key,$value['ata']);
        
            
                //$fir->atd = $item['atd'];
                 $activeSheet->setCellValue('D'.$key,$value['atd']);
           
            
                // $fir->deptdate = date("Y-m-d", strtotime($item['deptdate']));
                $activeSheet->setCellValue('E'.$key,date("Y-m-d", strtotime($value['deptdate'])));
           
       
                if($value['enroute']===1){  $activeSheet->setCellValue('F'.$key,"True");}
                else{ $activeSheet->setCellValue('F'.$key,"False"); }
               // $fir->enroute = $item['enroute'];
          
                 if($value['landing']===1){ $activeSheet->setCellValue('G'.$key,"True");}
                else{$activeSheet->setCellValue('G'.$key,"False"); }
                //$fir->landing = $item['enroute'];
            
                //$fir->entrytime = $item['entrytime'];
                $activeSheet->setCellValue('H'.$key,$value['entrytime']);
               
                //$fir->exittime= $item['exittime'];
               $activeSheet->setCellValue('I'.$key,$value['exittime']);

                // $fir->flightdate = date("Y-m-d", strtotime($item['flightdate']));
               $activeSheet->setCellValue('J'.$key,date("Y-m-d", strtotime($value['flightdate'])));


                $tbl = "airport";
                $col = "id";
               
               // $fir->from_id = NULL;
                $rowFrom = getItem($tbl, $col, $value['from_id']);
                if (!empty($rowFrom)) {
                   // $fir->from_id = $item['from_id'];
                    $activeSheet->setCellValue('K'.$key,$rowFrom['icao']);
                }
            
            
                 $tbl = "airport";
                $col = "id";
               
               // $fir->to_id = NULL;
                $rowTo = getItem($tbl, $col, $value['to_id']);
                if (!empty($rowTo)) {
                   // $fir->to_id = $item['to_id'];
                   $activeSheet->setCellValue('L'.$key,$rowTo['icao']);
                }

                //$fir->level = $item['level'];
                 $activeSheet->setCellValue('M'.$key,$value['level']);

                $tbl = "route";
                $col = "id";
               
               // $fir->route_id = NULL;
                $rowRoute = getItem($tbl, $col, $value['route_id']);
                if (!empty($rowRoute)) {
                  //  $fir->route_id = $item['route_id'];
                   $activeSheet->setCellValue('N'.$key,$rowRoute['name']); 
                }

               // $fir->callsign = $item['callsign'];
                $activeSheet->setCellValue('O'.$key,$value['callsign']);
  
                $tbl = "operator";
                $col = "id";
               
               // $fir->operator_fk = NULL;
                $rowOpr = getItem($tbl, $col, $value['operator_fk']);
                if (!empty($rowOpr)) {
                    //$fir->operator_fk = $item['operatorcode'];
                     $activeSheet->setCellValue('P'.$key,$rowOpr['operatorcode']);
                }
            $key++;
        }

    }

}

