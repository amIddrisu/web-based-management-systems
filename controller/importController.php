<?php

ini_set('memory_limit', '512M');
require_once '../service/importService.php';
/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


$ERROR_MSG = '';
$SUCCESS_MSG = '';
$aircraftItem = array('REGISTRATION', 'WEIGHT', 'AIRCRAFTTYPE');
$airportItem = array('NAME(4 Letter ICAO Code)', 'COUNTRY', 'CITY NAME', 'IATA CODE', 'AIRPORT NAME');
$operatorItem = array('CODE', 'NAME', 'ADDRESS', 'COUNTRY', 'EMAIL', 'FAX', 'PHONE', 'FLIGHTSTATUS(eg S or NS)', 'DESIGNATION(eg IATA)', 'COMMENT', 'REGIONAL');
$routeItem = array('ROUTE NAME', 'DISTANCE(in KMT)', 'WAYPOINTS');
$waypointItem = array('WAYPOINT NAME', 'BOUNDARY', 'LAT', 'LONG', 'UPPER/LOWER');
$firItem = array('AIRCRAFT(Registration)', 'ARRIVAL DATE', 'ATA', 'ATD', 'DEPARTURE DATE', 'ENROUTE(eg 1)', 'LANDING(eg 0)', 'ENTRY TIME', 'EXIT TIME', 'FLIGHT DATE', 'FROM', 'TO', 'FLIGHT LEVEL(in KM)', 'ROUTE', 'CALLSIGN', 'OPERATOR_CODE');
$excelColumn = array('A1', 'B1', 'C1', 'D1', 'E1', 'F1', 'G1', 'H1', 'I1', 'J1', 'K1', 'L1', 'M1', 'N1', 'O1', 'P1', 'Q1',);

// Create Template
if (isset($_POST['createTemplate'])) {

    $moduleName = $_POST['moduleName'];

    if ($moduleName == "none") {
        $ERROR_MSG = $ERROR_MSG . 'Please select a module. <br>';
    } else {
//create excel header
        $docTitle = $moduleName . ' Template';
        $objPHPExcel = excelheader($docTitle);


//Define file name
        $templateFileName = '../tmp/' . $moduleName . "_template.xlsx";

// Check specific module and  Add data of column titles
        switch ($moduleName) {
            case 'Aircraft':
                addTemplateData($templateFileName, $aircraftItem, $objPHPExcel, $excelColumn);
                break;
            case 'Airport':

                addTemplateData($templateFileName, $airportItem, $objPHPExcel, $excelColumn);
                break;
            case 'FIR':
                addTemplateData($templateFileName, $firItem, $objPHPExcel, $excelColumn);
                break;
            case 'Operator':

                addTemplateData($templateFileName, $operatorItem, $objPHPExcel, $excelColumn);
                break;
            case 'Route':
                addTemplateData($templateFileName, $routeItem, $objPHPExcel, $excelColumn);
                break;
            case 'Waypoint':
                addTemplateData($templateFileName, $waypointItem, $objPHPExcel, $excelColumn);
                break;
            default:
                $ERROR_MSG = $ERROR_MSG . 'Error is unknown contact your Systems Administrator. <br>';
                break;
        }
        $SUCCESS_MSG = $moduleName . ' Template successfully downloaded. <br>';
    }
}

// Validate Import Data
if (isset($_POST['validateData'])) {

    $moduleName = $_POST['moduleName'];

    if ($moduleName == "none") {
        $ERROR_MSG = $ERROR_MSG . 'Please select a module. <br>';
    } else {
//validate excel header and duplicates

        if (valFile()) {
            $uploaddir = '../tmp/';
            $uploadfile = $uploaddir . basename($_FILES['importFile']['name']);

            if (move_uploaded_file($_FILES['importFile']['tmp_name'], $uploadfile)) {

                /**  Identify the type of $inputFileName  * */
                $inputFileType = PHPExcel_IOFactory::identify($uploadfile);
                /**  Create a new Reader of the type that has been identified  * */
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setReadDataOnly(true);
                /**  Load $inputFileName to a PHPExcel Object  * */
                $objPHPExcel = $objReader->load($uploadfile);

                // Check specific module and  column titles before import
                switch ($moduleName) {
                    case 'Aircraft':
                        if (validateColumnModel($objPHPExcel, $aircraftItem)) {
                            $SUCCESS_MSG = $moduleName . ' Import file column titles successfully validated. <br>';
                        }
                        //Check duplicates
                        if (validateDuplicates($objPHPExcel, $moduleName)) {
                            $SUCCESS_MSG = $moduleName . ' Import file successfully validated. No duplicates detected. <br>';
                        }
                        break;
                    case 'Airport':

                        if (validateColumnModel($objPHPExcel, $airportItem)) {
                            $SUCCESS_MSG = $moduleName . ' Import file column titles successfully validated. <br>';
                        }
                        //Check duplicates
                        if (validateDuplicates($objPHPExcel, $moduleName)) {
                            $SUCCESS_MSG = $moduleName . ' Import file successfully validated. No duplicates detected. <br>';
                        }
                        break;
                    case 'FIR':
                        if (validateColumnModel($objPHPExcel, $firItem)) {
                            $SUCCESS_MSG = $moduleName . ' Import file column titles successfully validated. <br>';
                        }
                        //Check duplicates
                        //TODO
                        break;
                    case 'Operator':

                        if (validateColumnModel($objPHPExcel, $operatorItem)) {
                            $SUCCESS_MSG = $moduleName . ' Import file column titles successfully validated. <br>';
                        }
                        //Check duplicates
                        if (validateDuplicates($objPHPExcel, $moduleName)) {
                            $SUCCESS_MSG = $moduleName . ' Import file successfully validated. No duplicates detected. <br>';
                        }
                        break;
                    case 'Route':
                        if (validateColumnModel($objPHPExcel, $routeItem)) {

                            $SUCCESS_MSG = $moduleName . ' Import file column titles successfully validated. <br>';
                        }
                        //Check duplicates
                        if (validateDuplicates($objPHPExcel, $moduleName)) {
                            $SUCCESS_MSG = $moduleName . ' Import file successfully validated. No duplicates detected. <br>';
                        }
                        break;
                    case 'Waypoint':
                        if (validateColumnModel($objPHPExcel, $waypointItem)) {

                            $SUCCESS_MSG = $moduleName . ' Import file column titles successfully validated. <br>';
                        }
                        //Check duplicates
                        if (validateDuplicates($objPHPExcel, $moduleName)) {
                            $SUCCESS_MSG = $moduleName . ' Import file successfully validated. No duplicates detected. <br>';
                        }
                        break;
                    default:
                        $ERROR_MSG = $ERROR_MSG . 'Error is unknown contact your Systems Administrator. <br>';
                        break;
                }
            }
        }
    }
}

///validate duplicates function
function validateDuplicates($objPHPExcel, $moduleName) {
    global $ERROR_MSG;
    $objWorksheet = $objPHPExcel->getActiveSheet();
    $rowIndex = 0;
    foreach ($objWorksheet->getRowIterator() as $row) {
        $rowIndex = $row->getRowIndex();
        if (!( $rowIndex == 1)) {//Ignore header row 1
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
            // even if it is not set. By default, only cells that are set will be iterated.

            foreach ($cellIterator as $cell) {

                $cell_coord = $cell->getCoordinate();
                $cell_col = $cell->getColumn();
                $val = $cell->getValue();

                switch ($moduleName) {
                    case 'Aircraft':
                        if ('A' === $cell_col) {
                            if (isUniqueField('aircraft', 'name', $val)) {
                                $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . ': Value in cell ' . $cell_coord . ' already exist in the database. <br>';
                            }
                        }
                        break;
                    case 'Airport':
                        if ('A' === $cell_col) {
                            if (isUniqueField('airport', 'icao', $val)) {
                                $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . ': Value in cell ' . $cell_coord . ' already exist in the database. <br>';
                            }
                        }
                        if ('D' === $cell_col) {
                            if (isUniqueField('airport', 'iata', $val)) {
                                $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . ': Value in cell ' . $cell_coord . ' already exist in the database. <br>';
                            }
                        }
                        break;
                    case 'Operator':
                        if ('A' === $cell_col) {
                            if (isUniqueField('operator', 'operatorcode', $val)) {
                                $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . ': Value in cell ' . $cell_coord . ' already exist in the database. <br>';
                            }
                        }
                        break;
                    case 'Route':
                        if ('A' === $cell_col) {
                            if (isUniqueField('route', 'name', $val)) {
                                $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . ': Value in cell ' . $cell_coord . ' already exist in the database. <br>';
                            }
                        }
                        break;
                    case 'Waypoint':
                        if ('A' === $cell_col) {
                            if (isUniqueField('waypoint', 'name', $val)) {
                                $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . ': Value in cell ' . $cell_coord . ' already exist in the database. <br>';
                            }
                        }
                        break;
                    default:
                        $ERROR_MSG = $ERROR_MSG . 'Error is unknown contact your Systems Administrator. <br>';
                        return FALSE;
                }
            }
        }
    }
    if (empty($ERROR_MSG)) {
        return TRUE;
    }
    return FALSE;
}

if (isset($_POST['doImport'])) {
    $moduleName = $_POST['moduleName'];

    if ($moduleName == "none") {
        $ERROR_MSG = $ERROR_MSG . 'Please select a module. <br>';
    } else {

        if (valFile()) {
            $uploaddir = '../tmp/';
            $uploadfile = $uploaddir . basename($_FILES['importFile']['name']);

            if (move_uploaded_file($_FILES['importFile']['tmp_name'], $uploadfile)) {

                $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
                $cacheSettings = array(' memoryCacheSize ' => '10MB');
                PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

                /**  Identify the type of $inputFileName  * */
                $inputFileType = PHPExcel_IOFactory::identify($uploadfile);
                /**  Create a new Reader of the type that has been identified  * */
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);

               

                $objReader->setReadDataOnly(true);
                /**  Load $inputFileName to a PHPExcel Object  * */
                $objPHPExcel = $objReader->load($uploadfile);

                // Check specific module and  column titles before import
                switch ($moduleName) {
                    case 'Aircraft':
                        if (validateColumnModel($objPHPExcel, $aircraftItem) && validateDuplicates($objPHPExcel, $moduleName)) {
                            if (doImport($objPHPExcel, $moduleName)) {
                                $SUCCESS_MSG = $moduleName . ' Import successfull. &nbsp; <a href="../view/aircraftList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Click here to view LIST page</a><br>';
                            }
                        }
                        break;
                    case 'Airport':

                        if (validateColumnModel($objPHPExcel, $airportItem) && validateDuplicates($objPHPExcel, $moduleName)) {
                            if (doImport($objPHPExcel, $moduleName)) {
                                $SUCCESS_MSG = $moduleName . ' Import successfull. &nbsp; <a href="../view/airportList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Click here to view LIST page</a><br>';
                            }
                        }
                        break;
                    case 'FIR':
                        if (validateColumnModel($objPHPExcel, $firItem)) {
                            if (doImport($objPHPExcel, $moduleName)) {
                                $SUCCESS_MSG = $moduleName . ' Import successfull. &nbsp; <a href="../view/firList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Click here to view LIST page</a><br>';
                            }
                        }
                        break;
                    case 'Operator':

                        if (validateColumnModel($objPHPExcel, $operatorItem) && validateDuplicates($objPHPExcel, $moduleName)) {
                            if (doImport($objPHPExcel, $moduleName)) {
                                $SUCCESS_MSG = $moduleName . ' Import successfull. &nbsp; <a href="../view/operatorList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Click here to view LIST page</a><br>';
                            }
                        }
                        break;
                    case 'Route':
                        if (validateColumnModel($objPHPExcel, $routeItem) && validateDuplicates($objPHPExcel, $moduleName)) {
                            if (doImport($objPHPExcel, $moduleName)) {
                                $SUCCESS_MSG = $moduleName . ' Import successfull. &nbsp; <a href="../view/routeList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Click here to view LIST page</a><br>';
                            }
                        }
                        break;
                    case 'Waypoint':
                        if (validateColumnModel($objPHPExcel, $waypointItem) && validateDuplicates($objPHPExcel, $moduleName)) {
                            if (doImport($objPHPExcel, $moduleName)) {
                                $SUCCESS_MSG = $moduleName . ' Import successfull. &nbsp; <a href="../view/waypointList.php" title="List"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Click here to view LIST page</a><br>';
                            }
                        }
                        break;
                    default:
                        $ERROR_MSG = $ERROR_MSG . 'Error is unknown contact your Systems Administrator. <br>';
                        break;
                }
            }
        }
    }
}

function doImport($objPHPExcel, $moduleName) {

    global $ERROR_MSG;
    global $link;
    $objWorksheet = $objPHPExcel->getActiveSheet();
    $rowIndex = 0;
    $count = 0;
    $importService = new importService();
    foreach ($objWorksheet->getRowIterator() as $row) {
        $rowIndex = $row->getRowIndex();

        if (!( $rowIndex == 1)) {//Ignore header row 1
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
            // even if it is not set. By default, only cells that are set will be iterated.
            $count++;
            switch ($moduleName) {
                case 'Aircraft':

                    if ($count == 10000) {
                        $result = $importService->importAircraft($cellIterator, $ERROR_MSG);
                        if (!empty($ERROR_MSG)) {
                            $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . '<br>';
                        }
                        if ($result) {
                            mysqli_free_result($link, $result);
                            $count = 0;
                        }
                    } else {
                        $result = $importService->importAircraft($cellIterator, $ERROR_MSG);
                        if (!empty($ERROR_MSG)) {
                            $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . '<br>';
                        }
                    }
                    break;
                case 'Airport':

                    if ($count == 10000) {
                        $result = $importService->importAirport($cellIterator, $ERROR_MSG);
                        if (!empty($ERROR_MSG)) {
                            $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . '<br>';
                        }
                        if ($result) {
                            mysqli_free_result($link, $result);
                            $count = 0;
                        }
                    } else {
                        $result = $importService->importAirport($cellIterator, $ERROR_MSG);
                        if (!empty($ERROR_MSG)) {
                            $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . '<br>';
                        }
                    }

                    break;
                case 'Operator':

                    if ($count == 10000) {
                        $result = $importService->importOperator($cellIterator, $ERROR_MSG);
                        if (!empty($ERROR_MSG)) {
                            $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . '<br>';
                        }
                        if ($result) {
                            mysqli_free_result($link, $result);
                            $count = 0;
                        }
                    } else {
                        $result = $importService->importOperator($cellIterator, $ERROR_MSG);
                        if (!empty($ERROR_MSG)) {
                            $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . '<br>';
                        }
                    }

                    break;
                case 'Route':
                    if ($count == 10000) {
                        $result = $importService->importRoute($cellIterator, $ERROR_MSG);
                        if (!empty($ERROR_MSG)) {
                            $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . '<br>';
                        }
                        if ($result) {
                            mysqli_free_result($link, $result);
                            $count = 0;
                        }
                    } else {
                        $result = $importService->importRoute($cellIterator, $ERROR_MSG);
                        if (!empty($ERROR_MSG)) {
                            $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . '<br>';
                        }
                    }
                    break;
                case 'Waypoint':

                    if ($count == 10000) {
                        $result = $importService->importWaypoint($cellIterator, $ERROR_MSG);
                        if (!empty($ERROR_MSG)) {
                            $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . '<br>';
                        }
                        if ($result) {
                            mysqli_free_result($link, $result);
                            $count = 0;
                        }
                    } else {
                        $result = $importService->importWaypoint($cellIterator, $ERROR_MSG);
                        if (!empty($ERROR_MSG)) {
                            $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . '<br>';
                        }
                    }

                    break;
                case 'FIR':

                    if ($count == 10000) {
                        $result = $importService->importFIR($cellIterator, $ERROR_MSG);
                        if (!empty($ERROR_MSG)) {
                            $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . '<br>';
                        }
                        if ($result) {
                            mysqli_free_result($link, $result);
                            $count = 0;
                        }
                    } else {
                        $result = $importService->importFIR($cellIterator, $ERROR_MSG);
                        if (!empty($ERROR_MSG)) {
                            $ERROR_MSG = $ERROR_MSG . ' ROW ' . $rowIndex . '<br>';
                        }
                    }

                    break;
                default:
                    $ERROR_MSG = $ERROR_MSG . 'Error is unknown contact your Systems Administrator. <br>';
                    return FALSE;
            }
        }
    }
    if (empty($ERROR_MSG)) {
        return TRUE;
    }
    return FALSE;
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

function addTemplateData($templateFileName, $templateColumnNames, $objPHPExcel, $excelColumn) {

// Add some data

    $objPHPExcel->setActiveSheetIndex(0);
    foreach ($templateColumnNames as $key => $value) {
        $objPHPExcel->getActiveSheet()->setCellValue($excelColumn[$key], $value);
    }

// Ceate and Save Excel in 2007/2010/2012 file format
//$templateFileName
//

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save($templateFileName);
    redirect($templateFileName);
}

//Validate column titles
function validateColumnModel($objPHPExcel, $expItem) {


    $objWorksheet = $objPHPExcel->getActiveSheet();
    $isVal = FALSE;


    foreach ($objWorksheet->getRowIterator() as $row) {


        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
        // even if it is not set. By default, only cells that are set will be iterated.

        foreach ($cellIterator as $cell) {

            if (!is_null($cell) || !is_null($expItem)) {
                // $cell_coord = $cell->getCoordinate();
                $colHeader = $cell->getValue();
                if (in_array($colHeader, $expItem)) {
                    $isVal = TRUE;
                }
            }
        }
    }


    return $isVal;
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
        if (!($file_type == 'xls' )) {
            $ERROR_MSG = $ERROR_MSG . 'Invalid file format. The file format should be *.xls <br>';
            return false;
        }

        $SUCCESS_MSG = $SUCCESS_MSG . 'File is uploaded successfully. <br>';
        return true;
    } catch (RuntimeException $e) {

        return false;
    }
    return false;
}

?>
