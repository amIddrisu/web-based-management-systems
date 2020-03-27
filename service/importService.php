<?php

require_once 'commonService.php';
require_once '../model/aircraft.php';
require_once '../model/airport.php';
require_once '../model/operator.php';
require_once '../model/route.php';
require_once '../model/waypoint.php';
require_once '../model/fir.php';
require_once '../validation/aircraftValidation.php';
require_once '../validation/airportValidation.php';
require_once '../validation/operatorValidation.php';
require_once '../validation/routeValidation.php';
require_once '../validation/waypointValidation.php';
require_once '../validation/firValidation.php';
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
class importService {

    function importService() {
        
    }

    public function importAircraft($cellIterator, $ERROR_MSG) {
        global $link;
        $aircraft = new aircraft();
        $result = NULL;

        $cell_coord = '';
        foreach ($cellIterator as $cell) {

            $cell_coord = $cell->getCoordinate();
            $cell_col = $cell->getColumn();
            if ('A' === $cell_col) {
                $aircraft->name = $cell->getValue();
            }
            if ('B' === $cell_col) {
                $aircraft->weight = $cell->getValue();
                $aircraft->uom = 'Tonnes';
            }
            if ('C' === $cell_col) {
                $aircraft->aircrafttype = $cell->getValue();
            }
        }
        $res = new aircraftValidation();
        $res->ERROR_MSG = '';
        $aircraft->id = UUID::v4();
        $aircraft->helicopter = 0;
        $submittedby_id = $_SESSION["loggedid"];

        if ($res->validate($aircraft)) {

            $query = "INSERT INTO aircraft (id,name,aircrafttype,helicopter,uom,weight,submittedby_id)
   		VALUES ('$aircraft->id','$aircraft->name','$aircraft->aircrafttype','$aircraft->helicopter','$aircraft->uom','$aircraft->weight','$submittedby_id');";
            //debugout($query);
            $result = mysqli_query($link, $query);
            if (!$result) {
                $res->ERROR_MSG = $res->ERROR_MSG . 'Error: ' . mysqli_error($link) . "<br>";
            }


            if (!empty($res->ERROR_MSG)) {
                $res->ERROR_MSG = $res->ERROR_MSG . ' : Value in cell ' . $cell_coord;
            }
        }
        $ERROR_MSG = $res->ERROR_MSG;
        return $result;
    }

    public function importAirport($cellIterator, $ERROR_MSG) {
        global $link;
        $airport = new airport();
        $result = NULL;
        $cell_coord = '';
        foreach ($cellIterator as $cell) {

            $cell_coord = $cell->getCoordinate();
            $cell_col = $cell->getColumn();
            if ('A' === $cell_col) {
                $airport->icao = $cell->getValue();
            }
            if ('B' === $cell_col) {
                $airport->country = $cell->getValue();
            }
            if ('C' === $cell_col) {
                $airport->city = $cell->getValue();
            }
            if ('D' === $cell_col) {
                $airport->iata = $cell->getValue();
            }
            if ('E' === $cell_col) {
                $airport->name = $cell->getValue();
            }
        }
        $res = new airportValidation();
        $res->ERROR_MSG = '';
        $airport->id = UUID::v4();

        $submittedby_id = $_SESSION["loggedid"];
        // debugout($airport);
        if ($res->validate($airport)) {


            $query = "INSERT INTO airport (id,name,icao,iata,country,city,submittedby_id)
		VALUES (' $airport->id','$airport->name','$airport->icao','$airport->iata','$airport->country','$airport->city','$submittedby_id');";
            //debugout($query);
            $result = mysqli_query($link, $query);
            if (!$result) {
                $res->ERROR_MSG = $res->ERROR_MSG . 'Error: ' . mysqli_error($link) . "<br>";
            }


            if (!empty($res->ERROR_MSG)) {
                $res->ERROR_MSG = $res->ERROR_MSG . ' : Value in cell ' . $cell_coord;
            }
        }
        $ERROR_MSG = $res->ERROR_MSG;
        return $result;
    }

    public function importOperator($cellIterator, $ERROR_MSG) {
        global $link;
        $operator = new operator();
        $result = NULL;
        $cell_coord = '';
        foreach ($cellIterator as $cell) {

            $cell_coord = $cell->getCoordinate();
            $cell_col = $cell->getColumn();
            if ('A' === $cell_col) {
                $operator->operatorcode = $cell->getValue();
            }
            if ('B' === $cell_col) {
                $operator->name = $cell->getValue();
            }
            if ('C' === $cell_col) {
                $operator->address = $cell->getValue();
            }
            if ('D' === $cell_col) {
                $operator->country = $cell->getValue();
            }
            if ('E' === $cell_col) {
                $operator->email = $cell->getValue();
            }
            if ('F' === $cell_col) {
                $operator->fax = $cell->getValue();
            }
            if ('G' === $cell_col) {
                $operator->phone = $cell->getValue();
            }
            if ('H' === $cell_col) {
                $operator->flightstatus = $cell->getValue();
            }
            if ('I' === $cell_col) {
                $operator->designation = $cell->getValue();
            }
            if ('J' === $cell_col) {
                $operator->comment = $cell->getValue();
            }
            if ('K' === $cell_col) {
                $operator->regional = $cell->getValue();
            }
        }
        $res = new operatorValidation();
        $res->ERROR_MSG = '';
        $operator->id = UUID::v4();

        $submittedby_id = $_SESSION["loggedid"];

        if ($res->validate($operator)) {


            $query = "INSERT INTO operator (id,name,active,address,comment,country,
		designation,email,fax,flightstatus,operatorcode,phone,submittedby_id,regional)
		VALUES ('$operator->id','$operator->name','$operator->active','$operator->address','$operator->comment','$operator->country',
		'$operator->designation','$operator->email','$operator->fax','$operator->flightstatus','$operator->operatorcode','$operator->phone','$submittedby_id','$operator->regional');";

            $result = mysqli_query($link, $query);
            if (!$result) {
                $res->ERROR_MSG = $res->ERROR_MSG . 'Error: ' . mysqli_error($link) . "<br>";
            }


            if (!empty($res->ERROR_MSG)) {
                $res->ERROR_MSG = $res->ERROR_MSG . ' : Value in cell ' . $cell_coord;
            }
        }
        $ERROR_MSG = $res->ERROR_MSG;
        return $result;
    }

    public function importWaypoint($cellIterator, $ERROR_MSG) {
        global $link;
        $waypoint = new waypoint();
        $result = NULL;
        $cell_coord = '';
        foreach ($cellIterator as $cell) {

            $cell_coord = $cell->getCoordinate();
            $cell_col = $cell->getColumn();
            if ('A' === $cell_col) {
                $waypoint->name = $cell->getValue();
            }
            if ('B' === $cell_col) {
                $waypoint->boundary = $cell->getValue();
            }
            if ('C' === $cell_col) {
                $waypoint->lat = $cell->getValue();
            }
            if ('D' === $cell_col) {
                $waypoint->longi = $cell->getValue();
            }
            if ('E' === $cell_col) {
                $waypoint->way_type = $cell->getValue();
            }
        }
        $res = new waypointValidation();
        $res->ERROR_MSG = '';
        $waypoint->id = UUID::v4();

        $submittedby_id = $_SESSION["loggedid"];

        if ($res->validate($waypoint)) {


            $query = "INSERT INTO waypoint (id, name,lat, longi, way_type, boundary,submittedby_id)
                VALUES ('$waypoint->id','$waypoint->name','$waypoint->lat','$waypoint->longi','$waypoint->way_type','$waypoint->boundary','$waypoint->submittedby_id');";

            $result = mysqli_query($link, $query);
            if (!$result) {
                $res->ERROR_MSG = $res->ERROR_MSG . 'Error: ' . mysqli_error($link) . "<br>";
            }


            if (!empty($res->ERROR_MSG)) {
                $res->ERROR_MSG = $res->ERROR_MSG . ' : Value in cell ' . $cell_coord;
            }
        }
        $ERROR_MSG = $res->ERROR_MSG;
        return $result;
    }

    public function importRoute($cellIterator, $ERROR_MSG) {
        global $link;
        $route = new route();
        $result = NULL;
        $cell_coord = '';
        $itemWaypoints = array(); // waypoint ids
        foreach ($cellIterator as $cell) {

            $cell_coord = $cell->getCoordinate();
            $cell_col = $cell->getColumn();
            if ('A' === $cell_col) {
                $route->name = $cell->getValue();
            }
            if ('B' === $cell_col) {
                $route->distance = $cell->getValue();
            }

            if ('C' === $cell_col) {

                $items = array(); // waypoint names
                $waypoint = new waypoint();
                $tbl = "waypoint";
                $col = "name";
                $items = explode(',', $cell->getValue());

                foreach ($items as $key => $value) {
                    $row = getItem($tbl, $col, $value);
                    if (!empty($row)) {
                        $itemWaypoints[] = $waypoint->waypoint($row)->id;
                    }
                }

                $route->waypoints = implode(",", $itemWaypoints);
            }
        }
        $res = new routeValidation();
        $res->ERROR_MSG = '';
        $route->id = UUID::v4();
        $route->distuom = 'KMT';
        $submittedby_id = $_SESSION["loggedid"];

        if ($res->validate($route)) {
            //$route->waypoints = implode(",", $itemWaypoints);

            $query = "INSERT INTO route (id,name,distuom,distance,waypoints,submittedby_id) VALUES ('$route->id','$route->name','$route->distuom','$route->distance','$route->waypoints','$submittedby_id');";

            $result = mysqli_query($link, $query);
            if (!$result) {
                $res->ERROR_MSG = $res->ERROR_MSG . 'Error: ' . mysqli_error($link) . "<br>";
            }


            if (!empty($res->ERROR_MSG)) {
                $res->ERROR_MSG = $res->ERROR_MSG . ' : Value in cell ' . $cell_coord;
            }
        }
        $ERROR_MSG = $res->ERROR_MSG;
        return $result;
    }

    public function importFIR($cellIterator, $ERROR_MSG) {
        global $link;
        $fir = new fir();
        $result = NULL;
        $cell_coord = '';
        foreach ($cellIterator as $cell) {

            $cell_coord = $cell->getCoordinate();
            $cell_col = $cell->getColumn();
            if ('A' === $cell_col) {
                $tbl = "aircraft";
                $col = "name";
                $value = $cell->getValue();
                $fir->aircraft_id = NULL;
                $row = getItem($tbl, $col, $value);
                if (!empty($row)) {
                    $fir->aircraft_id = $row['id'];
                }
            }
            if ('B' === $cell_col) {
                $fir->arrdate = date("Y-m-d", strtotime($cell->getValue()));
            }
            if ('C' === $cell_col) {
                $fir->ata = $cell->getValue();
            }
            if ('D' === $cell_col) {
                $fir->atd = $cell->getValue();
            }
            if ('E' === $cell_col) {
                 $fir->deptdate = date("Y-m-d", strtotime($cell->getValue()));
            }
            if ('F' === $cell_col) {
                $fir->enroute = $cell->getValue();
            }
            if ('G' === $cell_col) {
                $fir->landing = $cell->getValue();
            }
            if ('H' === $cell_col) {
                $fir->entrytime = $cell->getValue();
            }
            if ('I' === $cell_col) {
                $fir->exittime = $cell->getValue();
            }
            if ('J' === $cell_col) {
                 $fir->flightdate = date("Y-m-d", strtotime($cell->getValue()));
            }
            if ('K' === $cell_col) {
                $tbl = "airport";
                $col = "icao";
                $value = $cell->getValue();
                $fir->from_id = NULL;
                $row = getItem($tbl, $col, $value);
                if (!empty($row)) {
                    $fir->from_id = $row['id'];
                }
            }
            if ('L' === $cell_col) {
                $tbl = "airport";
                $col = "icao";
                $value = $cell->getValue();
                $fir->to_id = NULL;
                $row = getItem($tbl, $col, $value);
                if (!empty($row)) {
                    $fir->to_id = $row['id'];
                }
            }
            if ('M' === $cell_col) {
                $fir->level = $cell->getValue();
            }
            if ('N' === $cell_col) {
                $tbl = "route";
                $col = "name";
                $value = $cell->getValue();
                $fir->route_id = NULL;
                $row = getItem($tbl, $col, $value);
                if (!empty($row)) {
                    $fir->route_id = $row['id'];
                }
            }
            if ('O' === $cell_col) {
                $fir->callsign = $cell->getValue();
            }
             if ('P' === $cell_col) {
                $tbl = "operator";
                $col = "operatorcode";
                $value = $cell->getValue();
                $fir->operator_fk = NULL;
                $row = getItem($tbl, $col, $value);
                if (!empty($row)) {
                    $fir->operator_fk = $row['id'];
                }
            }
        }
        
        $res = new firValidation();
        $res->ERROR_MSG = '';
        $fir->id = UUID::v4();
        $fir->anc=0;
         $modifiedById = $_SESSION["loggedid"];
        $submittedById = $_SESSION["loggedid"];
        
        if ($res->validate($fir)) {


            $query = "INSERT INTO fir (id, aircraft_id, anc, arrdate, ata, atd,  callsign,  deptdate, enroute,  entrytime, exittime, flightdate,  from_id,  landing,  level, modifiedby_id,  name, operator_fk, route_id, submittedby_id, to_id )
        VALUES('$fir->id', '$fir->aircraft_id', '$fir->anc', '$fir->arrdate', '$fir->ata', '$fir->atd',  '$fir->callsign',  '$fir->deptdate', '$fir->enroute',  '$fir->entrytime', '$fir->exittime', '$fir->flightdate', '$fir->from_id',  '$fir->landing',  '$fir->level', '$modifiedById',  '$fir->name', '$fir->operator_fk',  '$fir->route_id', '$submittedById',  '$fir->to_id');";
       
            $result = mysqli_query($link, $query);
            if (!$result) {
                
                $res->ERROR_MSG . 'Error: ' . mysqli_error($link) . "<br>";
            }


            if (!empty($res->ERROR_MSG)) {
                $res->ERROR_MSG = $res->ERROR_MSG . ' : Value in cell ' . $cell_coord;
            }
        }
        $ERROR_MSG = $res->ERROR_MSG;
        return $result;
    }

}
