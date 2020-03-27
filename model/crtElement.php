<?php

require '../include/header.php';
require_once '../util/uuid.php';

class CrtElement {

    public $id;
    public $crt_area;
    public $speciality;
    public $description;
    public $submitteddate;
    public $submittedby_id;
    public $modifieddate;
    public $modifiedby_id;
    public $plink;

    public function __construct() {
        global $link;
        $this->plink = $link;
    }

    //function for returning an instance of an crtElement based on a particular value from db
    function getCrtElement($id) {

        $sql = "SELECT * from crt_element where id='"."$id"."'";
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $crtElement = new CrtElement();
        if ($count == 1) {
            $crtElement = $this->crtElement($row);
        }
        return $crtElement;
    }
    
    //function for adding a record to the crtElement table in the db
    function addCrtElement($crtElement) {
        
        $submittedby_id = $_SESSION["loggedid"];
        $crtElement->id = UUID::v4();
        
        $query = "INSERT INTO crt_element (id,crt_area,speciality,description,submittedby_id) "
                . "VALUES ('$crtElement->id','$crtElement->crt_area','$crtElement->speciality','$crtElement->description','$submittedby_id');";

        mysqli_query($this->plink, $query);
        // close connection

      //  mysqli_close($this->plink);
   
        $url = "../view/crtElementList.php";
        
        redirect($url);
    }


    //deleting an crtElement instance from the db
    function deleteCrtElement($id,$all=false){
		
		if($all){
			$query="DELETE from crt_element  where id in (".$id.")";
		}else{
			$query="DELETE from crt_element  where id="."'$id'";	
		}
		
		mysqli_query($this->plink,$query);
		// close connection
		//mysqli_close($this->plink);
               
	}

        //updating an crtElement instance in the db
    function editCrtElement($crtElement) {

        //$this->perm_desc = $_POST['crtElement_desc'];

       // $modifieddate = date("d-m-Y H:i:s");
        $modifiedby_id = $_SESSION["loggedid"];

        $query = "UPDATE crt_element SET crt_area='$crtElement->crt_area',speciality='$crtElement->speciality',description='$crtElement->description',
   			modifiedby_id='$modifiedby_id' WHERE id=" . "'$crtElement->id'";
        mysqli_query($this->plink, $query);
        // close connection
       // mysqli_close($this->plink);
        $url = "../view/crtElementList.php";

        redirect($url);
    }

    //function for returning a record in the crtElement table
    function crtElement($row) {
        if (!empty($row)) {
            $crtElement = new CrtElement();
            foreach ($row as $key => $value) {
                $crtElement->$key = $value;
            }
            return $crtElement;
        }
    }

    //function for returning all crtElement objects in the db
    function getCrtElements() {

        //sql to return all crtElement objects
        $sql = "SELECT * from crt_element";
        $crtElements = array();
        $result = mysqli_query($this->plink, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $crtElements[] = $this->crtElement($row);
        }

        return $crtElements;
    }
    
//    function getCrtElementName() {
//       return $this->name;
//    }

}
