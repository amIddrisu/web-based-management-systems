<?php

require '../include/header.php';
require_once '../util/uuid.php';

class Unit {

    public $id;
    public $name;
    public $section_id;
    public $submitteddate;
    public $submittedby_id;
    public $modifieddate;
    public $modifiedby_id;
    public $plink;

    public function __construct() {
        global $link;
        $this->plink = $link;
    }

    //function for returning an instance of an unit based on a particular value from db
    function getUnit($id) {

        $sql = "SELECT * from unit where id='"."$id"."'";
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $unit = new Unit();
        if ($count == 1) {
            $unit = $this->unit($row);
        }
        return $unit;
    }
    
    //function for adding a record to the unit table in the db
    function addUnit($unit) {
        
        $submittedby_id = $_SESSION["loggedid"];
        $unit->id = UUID::v4();
        
        $query = "INSERT INTO unit (id,name,section_id,submittedby_id)"
                . "VALUES ('$unit->id','$unit->name','$unit->section_id','$submittedby_id');";

        mysqli_query($this->plink, $query);
        // close connection

      //  mysqli_close($this->plink);
   
        $url = "../view/unitList.php";
        
        redirect($url);
    }


    //deleting an unit instance from the db
    function deleteUnit($id,$all=false){
		
		if($all){
			$query="DELETE from unit  where id in (".$id.")";
		}else{
			$query="DELETE from unit  where id="."'$id'";	
		}
		
		mysqli_query($this->plink,$query);
		// close connection
		//mysqli_close($this->plink);
               
	}

        //updating an unit instance in the db
    function editUnit($unit) {

        //$this->perm_desc = $_POST['unit_desc'];

       // $modifieddate = date("d-m-Y H:i:s");
        $modifiedby_id = $_SESSION["loggedid"];

        $query = "UPDATE unit SET name='$unit->name',section_id='$unit->section_id',
   			modifiedby_id='$modifiedby_id' WHERE id=" . "'$unit->id'";
        mysqli_query($this->plink, $query);
        // close connection
       // mysqli_close($this->plink);
        $url = "../view/unitList.php";

        redirect($url);
    }

    //function for returning a record in the unit table
    function unit($row) {
        if (!empty($row)) {
            $unit = new Unit();
            foreach ($row as $key => $value) {
                $unit->$key = $value;
            }
            return $unit;
        }
    }

    //function for returning all unit objects in the db
    function getUnits() {

        //sql to return all unit objects
        $sql = "SELECT * from unit";
        $units = array();
        $result = mysqli_query($this->plink, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $units[] = $this->unit($row);
        }

        return $units;
    }
     public function showSectionOptions() {

        $sql = "SELECT * from section";
   //debugout($sql);
        $result = mysqli_query($this->plink, $sql);

        $opt = '';
        while ($row = mysqli_fetch_assoc($result)) {

            $opt .='<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
        }
        echo $opt;
    }
      
 
   

//    function getUnitName() {
//       return $this->name;
//    }

}
