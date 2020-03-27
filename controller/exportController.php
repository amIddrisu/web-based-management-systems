<?php

require_once '../service/exportService.php';
/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
$ERROR_MSG = '';
$SUCCESS_MSG = '';
$aircraftItem = array('REGISTRATION', 'WEIGHT', 'AIRCRAFTTYPE');
$airportItem = array('NAME(4 Letter ICAO Code)', 'COUNTRY', 'CITY NAME', 'IATA CODE', 'AIRPORT NAME');
$operatorItem = array('CODE', 'NAME', 'ADDRESS', 'COUNTRY', 'EMAIL', 'FAX', 'PHONE', 'FLIGHTSTATUS(eg S or NS)', 'DESIGNATION(eg IATA)', 'COMMENT', 'REGIONAL');
$routeItem = array('ROUTE NAME', 'DISTANCE(in KMT)', 'WAYPOINTS');
$waypointItem = array('WAYPOINT NAME', 'BOUNDARY', 'LAT', 'LONG', 'UPPER/LOWER');
$firItem = array('AIRCRAFT(eg Registration)', 'ARRIVAL DATE', 'ATA', 'ATD', 'DEPARTURE DATE', 'ENROUTE(eg TRUE)', 'LANDING(eg FALSE)', 'ENTRY TIME', 'EXIT TIME', 'FLIGHT DATE', 'FROM', 'TO', 'FLIGHT LEVEL(in KM)', 'ROUTE', 'CALLSIGN', 'OPERATOR_CODE');
$excelColumn = array('A1', 'B1', 'C1', 'D1', 'E1', 'F1', 'G1', 'H1', 'I1', 'J1', 'K1', 'L1', 'M1', 'N1', 'O1', 'P1', 'Q1',);

// Create Export File
if (isset($_POST['doExport'])) {

    $moduleName = $_POST['moduleName'];
    $startDate = date("Y-m-d", strtotime($_POST['startDate']));
    $endDate = date("Y-m-d", strtotime($_POST['endDate']));
   
    if ($moduleName == "none") {
        $ERROR_MSG = $ERROR_MSG . 'Please select a module. <br>';
    } else {
//create excel header
        $docTitle = $moduleName . ' Export';
        $objPHPExcel = excelheader($docTitle);


//Define file name
        $exportFileName = '../tmp/' . $moduleName . "_export.xlsx";

// Check specific module and  Add data of column titles
        switch ($moduleName) {
            case 'Aircraft':
                //addExportData($exportFileName, $aircraftItem, $objPHPExcel, $excelColumn,$startDate,$endDate);
                break;
            case 'Airport':

               // addExportData($exportFileName, $airportItem, $objPHPExcel, $excelColumn);
                break;
            case 'FIR':
                addExportData($exportFileName, $firItem, $objPHPExcel, $excelColumn,$startDate,$endDate);
                 
                break;
            case 'Operator':

               // addExportData($exportFileName, $operatorItem, $objPHPExcel, $excelColumn);
                break;
            case 'Route':
               // addExportData($exportFileName, $routeItem, $objPHPExcel, $excelColumn);
                break;
            case 'Waypoint':
               // addExportData($exportFileName, $waypointItem, $objPHPExcel, $excelColumn);
                break;
            default:
                $ERROR_MSG = $ERROR_MSG . 'Error is unknown contact your Systems Administrator. <br>';
                break;
        }
        $SUCCESS_MSG = $moduleName . ' successfully exported. <br>';
    }
}


function excelheader($docTitle) {
    /** Error reporting */
    $ERROR_MSG = '';
    $ERROR_MSG = error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    date_default_timezone_set('Africa/Accra');

//define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
// Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

// Set document properties
    $objPHPExcel->getProperties()->setCreator("Billing Software")
            ->setLastModifiedBy("Billing Software - Systems Administrator")
            ->setTitle($docTitle)
            ->setSubject($docTitle)
            ->setDescription($docTitle)
            ->setKeywords($docTitle)
            ->setCategory($docTitle);
    return $objPHPExcel;
}

function addExportData($exportFileName, $exportColumnNames, $objPHPExcel, $excelColumn,$startDate,$endDate) {

// Add some data

    $objPHPExcel->setActiveSheetIndex(0);
    foreach ($exportColumnNames as $key => $value) {
      $objPHPExcel->getActiveSheet()->setCellValue($excelColumn[$key], $value);
   }
    
  

 global $ERROR_MSG;
 global $moduleName;
    $rowIndex = 0;
    $count = 0;
    $exportService = new exportService();
    $items =  Array();

            $count++;
            switch ($moduleName) {
                case 'Aircraft':
                   /// TODO
                    break;
                case 'Airport':
                   ///TODO
                    break;
                case 'Operator':
                    ///TODO
                    
                    break;
                case 'Route':
                    ///TODO
                    break;
                case 'Waypoint':
                    ///TODO
                    break;
                case 'FIR':
                     $items=getItems("fir", "flightdate", $startDate, $endDate);
                   
                        $exportService->exportFIR($objPHPExcel->getActiveSheet(),$ERROR_MSG,$items);

                          

                    break;
                default:
                    $ERROR_MSG = $ERROR_MSG . 'Error is unknown contact your Systems Administrator. <br>';
                    return FALSE;
            }
    
    
    if (empty($ERROR_MSG)) {
        // Ceate and Save Excel in 2007/2010/2012 file format
//$templateFileName
//

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save($exportFileName);
    redirect($exportFileName);
        return TRUE;
    }
    
    return FALSE;   
  }  
    
    
    
    
    
    
    
    





function valFile() {
    global $ERROR_MSG;
    global $SUCCESS_MSG;
    try {
        // Check $_FILES['importFile']['error'] value.
        switch ($_FILES['importFile']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                $ERROR_MSG = $ERROR_MSG . 'No file sent. Please select a file. <br>';
                return false;
            case UPLOAD_ERR_INI_SIZE:
                $ERROR_MSG = $ERROR_MSG . 'Exceeded filesize limit. <br>';
                return false;
            case UPLOAD_ERR_FORM_SIZE:
                $ERROR_MSG = $ERROR_MSG . 'Exceeded filesize limit. <br>';
                return false;
            case UPLOAD_ERR_PARTIAL:
                $ERROR_MSG = $ERROR_MSG . 'The uploaded file was only partially uploaded. <br>';
                return false;
            default:
                $ERROR_MSG = $ERROR_MSG . 'Error is unknown contact your Systems Administrator. <br>';
                return false;
        }

        // You should also check filesize here.
        if ($_FILES['importFile']['size'] > 30000000) {
            $ERROR_MSG = $ERROR_MSG . 'Exceeded filesize limit! File should not exceed 1000000<br>';
            return false;
        }


        $namef = $_FILES['importFile']['name'];
        $array_filename = explode(".", $namef);
        $file_type = strtolower($array_filename[count($array_filename) - 1]);

        // Check file extension.
        if (!($file_type == 'xls' || $file_type == 'xlsx')) {
            $ERROR_MSG = $ERROR_MSG . 'Invalid file format. <br>';
            return false;
        }

        $SUCCESS_MSG = $SUCCESS_MSG . 'File is uploaded successfully. <br>';
        return true;
    } catch (RuntimeException $e) {

        return false;
    }
    return false;
}


