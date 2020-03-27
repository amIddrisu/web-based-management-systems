<?php

require '../include/header.php';
require_once '../util/uuid.php';

class AuditSchedule {

    public $id;
    public $from_date;
    public $scp_number;
    public $dept_id;
    public $section_id;
    public $unit_id;
    public $to_date;
    public $submitteddate;
    public $submittedby_id;
    public $modifieddate;
    public $modifiedby_id;
    public $plink;

    public function __construct() {
        global $link;
        $this->plink = $link;
    }

    //function for returning an instance of an auditSchedule based on a particular value from db
    function getAuditSchedule($id) {

        $sql = "SELECT * from audit_schedule where id='"."$id"."'";
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $auditSchedule = new AuditSchedule();
        if ($count == 1) {
            $auditSchedule = $this->auditSchedule($row);
        }
        return $auditSchedule;
    }
    
    //function for adding a record to the auditSchedule table in the db
    function addAuditSchedule($auditSchedule) {
        
        $submittedby_id = $_SESSION["loggedid"];
        $auditSchedule->id = UUID::v4();
        
        $query = "INSERT INTO audit_schedule (id,from_date,scp_number,dept_id,section_id,unit_id,to_date,submittedby_id)"
                . "VALUES ('$auditSchedule->id','$auditSchedule->from_date','$auditSchedule->scp_number','$auditSchedule->dept_id','$auditSchedule->section_id','$auditSchedule->unit_id','$auditSchedule->to_date','$submittedby_id');";

        mysqli_query($this->plink, $query);
        // close connection

      //  mysqli_close($this->plink);
   
        $url = "../view/auditScheduleList.php";
        
        redirect($url);
    }


    //deleting an auditSchedule instance from the db
    function deleteAuditSchedule($id,$all=false){
		
		if($all){
			$query="DELETE from audit_schedule  where id in (".$id.")";
		}else{
			$query="DELETE from audit_schedule  where id="."'$id'";	
		}
		
		mysqli_query($this->plink,$query);
		// close connection
		//mysqli_close($this->plink);
               
	}

        //updating an auditSchedule instance in the db
    function editAuditSchedule($auditSchedule) {

        //$this->perm_desc = $_POST['auditSchedule_desc'];

       // $modifieddate = date("d-m-Y H:i:s");
        $modifiedby_id = $_SESSION["loggedid"];

        $query = "UPDATE audit_schedule SET from_date='$auditSchedule->from_date',scp_number='$auditSchedule->scp_number',dept_id='$auditSchedule->dept_id',section_id='$auditSchedule->section_id',unit_id='$auditSchedule->unit_id',to_date='$auditSchedule->to_date',
   			modifiedby_id='$modifiedby_id' WHERE id=" . "'$auditSchedule->id'";
        mysqli_query($this->plink, $query);
        // close connection
       // mysqli_close($this->plink);
        $url = "../view/auditScheduleList.php";

        redirect($url);
    }

    //function for returning a record in the auditSchedule table
    function auditSchedule($row) {
        if (!empty($row)) {
            $auditSchedule = new AuditSchedule();
            foreach ($row as $key => $value) {
                $auditSchedule->$key = $value;
            }
            return $auditSchedule;
        }
    }

    //function for returning all auditSchedule objects in the db
    function getAuditSchedules() {

        //sql to return all auditSchedule objects
        $sql = "SELECT * from audit_schedule";
        $auditSchedules = array();
        $result = mysqli_query($this->plink, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $auditSchedules[] = $this->auditSchedule($row);
        }

        return $auditSchedules;
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
       public function showScopeOptions() {

        $sql = "SELECT * from scope";
   //debugout($sql);
        $result = mysqli_query($this->plink, $sql);

        $opt = '';
        while ($row = mysqli_fetch_assoc($result)) {

            $opt .='<option value="' . $row['scp_number'] . '">' . $row['scp_number'] . '</option>';
        }
        echo $opt;
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
         public function showUnitOptions() {

        $sql = "SELECT * from unit";
   //debugout($sql);
        $result = mysqli_query($this->plink, $sql);

        $opt = '';
        while ($row = mysqli_fetch_assoc($result)) {

            $opt .='<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
        }
        echo $opt;
    }

//    function getAuditScheduleName() {
//       return $this->name;
//    }

}
