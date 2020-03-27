<?php
require_once  'commonService.php';
require_once '../model/aircraft.php';


class aircraftService {

    public $plink;
    public $ERROR_MSG ='';

    function aircraftService() {
        global $link;
        $this->plink = $link;
    }

    public function getAircraft($id) {
        //sql to return user object
        $aircraft = new aircraft();
        $sql = "select * from aircraft where id=" . '"' . $id . '"';

        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($count == 1) {
            $aircraft = $this->aircraft($row);
        }

        return $aircraft;
    }

    public static function aircraft($row) {
        if (!empty($row)) {
            $aircraft = new aircraft();
            foreach ($row as $key => $value) {
                $aircraft->$key = $value;
            }
            return $aircraft;
        }
    }

    public function getAircrafts() {
        //sql to return all user objects
        $sql = "select * from aircraft";
        $result = mysqli_query($this->plink, $sql);
        $aircrafts = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $aircrafts[] = $this->aircraft($rows);
        }
        return $aircrafts;
    }
    public function getAircraftList($limit) {
        //sql to return all user objects
        $start=0;
        $limit=100;
        $sidx='name';
        $sql = "SELECT * FROM aircraft ORDER BY $sidx LIMIT $start , $limit"; 
        $result = mysqli_query($this->plink, $sql);
        $aircrafts = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $aircrafts[] = $this->aircraft($rows);
        }
        return $aircrafts;
    }

    public function add($aircraft) {

        $aircraft->id = UUID::v4();
        $submittedby_id = $_SESSION["loggedid"];  

        $query = "INSERT INTO aircraft (id,name,aircrafttype,helicopter,uom,weight,submittedby_id)
   		VALUES ('$aircraft->id','$aircraft->name','$aircraft->aircrafttype','$aircraft->helicopter','$aircraft->uom','$aircraft->weight','$submittedby_id');";
        //debugout($query);
        $result=mysqli_query($this->plink, $query);
        if (!$result) {
            $this->ERROR_MSG = $this->ERROR_MSG.'Error: ' . mysqli_error($this->plink) . "<br>";
            return $this->ERROR_MSG;
        }
        // close connection

       // mysqli_close($this->plink);
        
    }

    public function edit($aircraft) {

        $modifiedby_id = $_SESSION["loggedid"];
       
        $query = "UPDATE aircraft SET name='$aircraft->name',aircrafttype='$aircraft->aircrafttype',helicopter='$aircraft->helicopter',uom='$aircraft->uom',weight='$aircraft->weight',
   			modifiedby_id='$modifiedby_id' WHERE id=" . "'$aircraft->id'";

       $result=mysqli_query($this->plink, $query);
        if (!$result) {
            $this->ERROR_MSG = $this->ERROR_MSG.'Error: ' . mysqli_error($this->plink) . "<br>";
            return $this->ERROR_MSG;
        }
        // close connection
        mysqli_close($this->plink);
        $url = "../view/aircraftView.php?id=$aircraft->id";

        redirect($url);
    }

     public function getDelete($id, $all = false) {
        
        if (!is_null($id) || !empty($id)) {
            if ($all) {
                $query = "DELETE from aircraft  where id in (" . $id . ")";
            } else {
                $query = "DELETE from aircraft  where id=" . "'$id'";
            }

            mysqli_query($this->plink, $query);
            // close connection
            mysqli_close($this->plink);
        }
        $url = "../view/aircraftList.php";
        redirect($url);
    }

    public function getCount($id) {

        $query = "select * from aircraft  where id=" . $id;
        $result = mysqli_query($this->plink, $query);
        return mysqli_num_rows($result);
    }
     public function validateBeforeImport() {
        //TODO
        
    }
    
    public function doImport($modelItem) {
        //TODO
        
        
    }

}


