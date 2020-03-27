<?php

require '../include/header.php';
require_once '../util/uuid.php';

class ToReference {

    public $id;
    public $tor_to;
    public $tor_cc;
    public $audit_date;
    public $audit_ref_num;
    public $scp_number;
    public $dept_id;
    public $section_id;
    public $unit_id;
    public $objective;
    public $assignm_strategy;
    public $deliverables;
    public $report_dist;
    public $overview_audit_cov;
    public $submitteddate;
    public $submittedby_id;
    public $modifieddate;
    public $modifiedby_id;
    public $plink;

    public function __construct() {
        global $link;
        $this->plink = $link;
    }

    //function for returning an instance of an toReference based on a particular value from db
    function getToReference($id) {

        $sql = "SELECT * from to_reference where id='"."$id"."'";
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $toReference = new ToReference();
        if ($count == 1) {
            $toReference = $this->toReference($row);
        }
        return $toReference;
    }
    
    //function for adding a record to the toReference table in the db
    function addToReference($toReference) {
        
        $submittedby_id = $_SESSION["loggedid"];
        $toReference->id = UUID::v4();
        
        $query = "INSERT INTO to_reference (id,tor_to,tor_cc,audit_date,audit_ref_num,scp_number,dept_id,section_id,unit_id,objective,assignm_strategy,deliverables,report_dist,overview_audit_cov,submittedby_id)"
                . "VALUES ('$toReference->id','$toReference->tor_to','$toReference->tor_cc','$toReference->audit_date','$toReference->audit_ref_num','$toReference->scp_number','$toReference->dept_id','$toReference->section_id','$toReference->unit_id','$toReference->objective','$toReference->assignm_strategy','$toReference->deliverables','$toReference->report_dist','$toReference->overview_audit_cov','$submittedby_id');";
       
        mysqli_query($this->plink, $query);
         
        // close connection

      //  mysqli_close($this->plink);
   
        $url = "../view/toReferenceList.php";
        
        redirect($url);
    }


    //deleting an toReference instance from the db
    function deleteToReference($id,$all=false){
		
		if($all){
			$query="DELETE from to_reference  where id in (".$id.")";
		}else{
			$query="DELETE from to_reference  where id="."'$id'";	
		}
		
		mysqli_query($this->plink,$query);
		// close connection
		//mysqli_close($this->plink);
               
	}

        //updating an toReference instance in the db
    function editToReference($toReference) {

        //$this->perm_desc = $_POST['toReference_desc'];

       // $modifieddate = date("d-m-Y H:i:s");
        $modifiedby_id = $_SESSION["loggedid"];

        $query = "UPDATE to_reference SET tor_to='$toReference->tor_to',tor_cc='$toReference->tor_cc',audit_date='$toReference->audit_date',audit_ref_num='$toReference->audit_ref_num',scp_number='$toReference->scp_number',dept_id='$toReference->dept_id',section_id='$toReference->section_id',unit_id='$toReference->unit_id',objective='$toReference->objective',assignm_strategy='$toReference->assignm_strategy',deliverables='$toReference->deliverables',report_dist='$toReference->report_dist',overview_audit_cov='$toReference->overview_audit_cov',
   			modifiedby_id='$modifiedby_id' WHERE id=" . "'$toReference->id'";
        mysqli_query($this->plink, $query);
        // close connection
       // mysqli_close($this->plink);
        $url = "../view/toReferenceList.php";

        redirect($url);
    }

    //function for returning a record in the toReference table
    function toReference($row) {
        if (!empty($row)) {
            $toReference = new ToReference();
            foreach ($row as $key => $value) {
                $toReference->$key = $value;
            }
            return $toReference;
        }
    }

    //function for returning all toReference objects in the db
    function getToReferences() {

        //sql to return all toReference objects
        $sql = "SELECT * from to_reference";
        $toReferences = array();
        $result = mysqli_query($this->plink, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $toReferences[] = $this->toReference($row);
        }

        return $toReferences;
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
          public function showScopeOptions() {

        $sql = "SELECT * from scope";
   //debugout($sql);
        $result = mysqli_query($this->plink, $sql);

        $opt = '';
        while ($row = mysqli_fetch_assoc($result)) {

            $opt .='<option value="' . $row['scp_number'] . '">' . $row['scp_number'] . '</option>';
        }
        echo $opt;

//    function getToReferenceName() {
//       return $this->name;
//    }

}
}
