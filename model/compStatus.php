<?php

require '../include/header.php';
require_once '../util/uuid.php';

class CompStatus {

    public $id;
    public $name;
    public $submitteddate;
    public $submittedby_id;
    public $modifieddate;
    public $modifiedby_id;
    public $plink;

    public function __construct() {
        global $link;
        $this->plink = $link;
    }

    //function for returning an instance of an compStatus based on a particular value from db
    function getCompStatus($id) {

        $sql = "SELECT * from comp_status where id='"."$id"."'";
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $compStatus = new CompStatus();
        if ($count == 1) {
            $compStatus = $this->compStatus($row);
        }
        return $compStatus;
    }
    
    //function for adding a record to the compStatus table in the db
    function addCompStatus($compStatus) {
        
        $submittedby_id = $_SESSION["loggedid"];
        $compStatus->id = UUID::v4();
        
        $query = "INSERT INTO compStatus (id,name,submittedby_id) "
                . "VALUES ('$compStatus->id','$compStatus->name','$submittedby_id');";

        mysqli_query($this->plink, $query);
        // close connection

      //  mysqli_close($this->plink);
   
        $url = "../view/compStatusList.php";
        
        redirect($url);
    }


    //deleting an compStatus instance from the db
    function deleteCompStatus($id,$all=false){
		
		if($all){
			$query="DELETE from comp_status  where id in (".$id.")";
		}else{
			$query="DELETE from comp_status  where id="."'$id'";	
		}
		
		mysqli_query($this->plink,$query);
		// close connection
		//mysqli_close($this->plink);
               
	}

        //updating an compStatus instance in the db
    function editCompStatus($compStatus) {

        //$this->perm_desc = $_POST['compStatus_desc'];

       // $modifieddate = date("d-m-Y H:i:s");
        $modifiedby_id = $_SESSION["loggedid"];

        $query = "UPDATE comp_status SET name='$compStatus->name',
   			modifiedby_id='$modifiedby_id' WHERE id=" . "'$compStatus->id'";
        mysqli_query($this->plink, $query);
        // close connection
       // mysqli_close($this->plink);
        $url = "../view/compStatusList.php";

        redirect($url);
    }

    //function for returning a record in the compStatus table
    function compStatus($row) {
        if (!empty($row)) {
            $compStatus = new CompStatus();
            foreach ($row as $key => $value) {
                $compStatus->$key = $value;
            }
            return $compStatus;
        }
    }

    //function for returning all compStatus objects in the db
    function getCompStatuss() {

        //sql to return all compStatus objects
        $sql = "SELECT * from comp_status";
        $compStatuss = array();
        $result = mysqli_query($this->plink, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $compStatuss[] = $this->compStatus($row);
        }

        return $compStatuss;
    }
    
//    function getCompStatusName() {
//       return $this->name;
//    }

}
