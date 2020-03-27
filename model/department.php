<?php

require '../include/header.php';
require_once '../util/uuid.php';

class Department {

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

    //function for returning an instance of an department based on a particular value from db
    function getDepartment($id) {

        $sql = "SELECT * from department where id='"."$id"."'";
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $department = new Department();
        if ($count == 1) {
            $department = $this->department($row);
        }
        return $department;
    }
    
    //function for adding a record to the department table in the db
    function addDepartment($department) {
        
        $submittedby_id = $_SESSION["loggedid"];
        $department->id = UUID::v4();
        
        $query = "INSERT INTO department (id,name,submittedby_id) "
                . "VALUES ('$department->id','$department->name','$submittedby_id');";

        mysqli_query($this->plink, $query);
        // close connection

      //  mysqli_close($this->plink);
   
        $url = "../view/departmentList.php";
        
        redirect($url);
    }


    //deleting an department instance from the db
    function deleteDepartment($id,$all=false){
		
		if($all){
			$query="DELETE from department  where id in (".$id.")";
		}else{
			$query="DELETE from department  where id="."'$id'";	
		}
		
		mysqli_query($this->plink,$query);
		// close connection
		//mysqli_close($this->plink);
               
	}

        //updating an department instance in the db
    function editDepartment($department) {

        //$this->perm_desc = $_POST['department_desc'];

       // $modifieddate = date("d-m-Y H:i:s");
        $modifiedby_id = $_SESSION["loggedid"];

        $query = "UPDATE department SET name='$department->name',
   			modifiedby_id='$modifiedby_id' WHERE id=" . "'$department->id'";
        mysqli_query($this->plink, $query);
        // close connection
       // mysqli_close($this->plink);
        $url = "../view/departmentList.php";

        redirect($url);
    }

    //function for returning a record in the department table
    function department($row) {
        if (!empty($row)) {
            $department = new Department();
            foreach ($row as $key => $value) {
                $department->$key = $value;
            }
            return $department;
        }
    }

    //function for returning all department objects in the db
    function getDepartments() {

        //sql to return all department objects
        $sql = "SELECT * from department";
        $departments = array();
        $result = mysqli_query($this->plink, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $departments[] = $this->department($row);
        }

        return $departments;
    }
    
//    function getDepartmentName() {
//       return $this->name;
//    }

}
