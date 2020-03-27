<?php

require '../include/header.php';
require_once '../util/uuid.php';

class Section {

    public $id;
    public $name;
    public $dept_id;
    public $submitteddate;
    public $submittedby_id;
    public $modifieddate;
    public $modifiedby_id;
    public $plink;

    public function __construct() {
        global $link;
        $this->plink = $link;
    }

    //function for returning an instance of an section based on a particular value from db
    function getSection($id) {

        $sql = "SELECT * from section where id='"."$id"."'";
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $section = new Section();
        if ($count == 1) {
            $section = $this->section($row);
        }
        return $section;
    }
    
    //function for adding a record to the section table in the db
    function addSection($section) {
        
        $submittedby_id = $_SESSION["loggedid"];
        $section->id = UUID::v4();
        
        $query = "INSERT INTO section (id,name,dept_id,submittedby_id) "
                . "VALUES ('$section->id','$section->name','$section->dept_id','$submittedby_id');";

        mysqli_query($this->plink, $query);
        // close connection

      //  mysqli_close($this->plink);
   
        $url = "../view/sectionList.php";
        
        redirect($url);
    }


    //deleting an section instance from the db
    function deleteSection($id,$all=false){
		
		if($all){
			$query="DELETE from section  where id in (".$id.")";
		}else{
			$query="DELETE from section  where id="."'$id'";	
		}
		
		mysqli_query($this->plink,$query);
		// close connection
		//mysqli_close($this->plink);
               
	}

        //updating an section instance in the db
    function editSection($section) {

        //$this->perm_desc = $_POST['section_desc'];

       // $modifieddate = date("d-m-Y H:i:s");
        $modifiedby_id = $_SESSION["loggedid"];

        $query = "UPDATE section SET name='$section->name',dept_id='$section->dept_id',
   			modifiedby_id='$modifiedby_id' WHERE id=" . "'$section->id'";
        mysqli_query($this->plink, $query);
        // close connection
       // mysqli_close($this->plink);
        $url = "../view/sectionList.php";

        redirect($url);
    }

    //function for returning a record in the section table
    function section($row) {
        if (!empty($row)) {
            $section = new Section();
            foreach ($row as $key => $value) {
                $section->$key = $value;
            }
            return $section;
        }
    }

    //function for returning all section objects in the db
    function getSections() {

        //sql to return all section objects
        $sql = "SELECT * from section";
        $sections = array();
        $result = mysqli_query($this->plink, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $sections[] = $this->section($row);
        }

        return $sections;
    }
    public function showDepartmentOptions() {

        $sql = "SELECT * from department";
   //debugout($sql);
        $result = mysqli_query($this->plink, $sql);

        $opt = '';
        while ($row = mysqli_fetch_assoc($result)) {

            $opt .='<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
        }
        echo $opt;
    }
//    function getSectionName() {
//       return $this->name;
//    }

}
