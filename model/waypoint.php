<?php

require_once '../include/header.php';
require_once '../util/uuid.php';

class waypoint {

    public $id;
    public $name;
    public $boundary;
    public $lat;
    public $longi;
    public $way_type;
    public $submittedby_id;
    public $modifiedby_id;
    public $modifieddate;
    public $submitteddate;
    public $ERROR_MSG ='';

    public function __construct() {
        global $link;
        $this->plink = $link;
    }

    function getWaypoint($id) {
        
        $sql = "SELECT * from waypoint where id = "  . '"' . $id . '"';
        // debugout($sql);
      $waypoint = new waypoint();
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($count == 1) {
            $waypoint = $this->waypoint($row);
        }

        return $waypoint;
    }

    function addWaypoint($data) {
            $this->id = UUID::v4();
         $this->way_type =$data->way_type;
        $this->boundary = $data->boundary;
        $this->name = $data->name;
        $this->lat = $data->lat;
        $this->longi = $data->longi;
       
        //$submitteddate = date("d-m-Y H:i:s");
        $this->submittedby_id = $_SESSION["loggedid"];
        
        
        $query = "INSERT INTO waypoint (id, name,lat, longi, way_type, boundary,submittedby_id)
                VALUES ('$this->id','$this->name','$this->lat','$this->longi','$this->way_type','$this->boundary','$this->submittedby_id');";
        
        $result=mysqli_query($this->plink, $query);
        if (!$result) {
            $this->ERROR_MSG = $this->ERROR_MSG.'Error: ' . mysqli_error($this->plink) . "<br>";
            return $this->ERROR_MSG;
        }
        // close connection

       mysqli_close($this->plink);
   
        $url = "../view/waypointView.php?id=$this->id";
        
        redirect($url);
    }


    function deleteWaypoint($id,$all=false){
		
		if($all){
			$query="DELETE from waypoint where id in (".$id.")";
		}else{
			$query="DELETE from waypoint  where id="."'$id'";	
		}
		
		mysqli_query($this->plink,$query);
		// close connection
		//mysqli_close($this->plink);
                $url = "../view/waypointList.php";
                redirect($url);
	}

    function editWaypoint($data) {
            $this->id = $data->id;
         $this->way_type =$data->way_type;
        $this->boundary = $data->boundary;
        $this->name = $data->name;
        $this->lat = $data->lat;
        $this->longi = $data->longi;
        //$submitteddate = date("d-m-Y H:i:s");
        $this->modifiedby_id = $_SESSION["loggedid"];

   $query = "UPDATE waypoint SET name='$this->name',lat='$this->lat',"
           . "longi='$this->longi',way_type='$this->way_type',boundary='$this->boundary',modifiedby_id='$this->modifiedby_id' WHERE id=" . "'$this->id'";
        $result=mysqli_query($this->plink, $query);
        if (!$result) {
            $this->ERROR_MSG = $this->ERROR_MSG.'Error: ' . mysqli_error($this->plink) . "<br>";
            return $this->ERROR_MSG;
        }
        // close connection
       mysqli_close($this->plink);
        $url = "../view/waypointView.php?id=$this->id";

        redirect($url);
    }

    function waypoint($row) {
        if (!empty($row)) {
            $waypoint = new waypoint();
            foreach ($row as $key => $value) {
                $waypoint->$key = $value;
            }
            return $waypoint;
        }
    }

    function getWaypoints() {

        //sql to return all waypoint objects
        $sql = "SELECT * from waypoint";
        $waypoints = array();
        $result = mysqli_query($this->plink, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $waypoints[] = $this->waypoint($row);
        }

        return $waypoints;
    }


}
