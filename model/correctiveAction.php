<?php

require '../include/header.php';
require_once '../util/uuid.php';

class CorrectiveAction {

    public $id;
    public $finding_num;
    public $status;
    public $description;
    public $finding_priority;
    public $start_date;
    public $finding_priority_date;
    public $finish_date;
    public $submitteddate;
    public $submittedby_id;
    public $modifieddate;
    public $modifiedby_id;
    public $plink;

    public function __construct() {
        global $link;
        $this->plink = $link;
    }

    //function for returning an instance of an correctiveAction based on a particular value from db
    function getCorrectiveAction($id) {

        $sql = "SELECT * from corrective_action where id='"."$id"."'";
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $correctiveAction = new CorrectiveAction();
        if ($count == 1) {
            $correctiveAction = $this->correctiveAction($row);
        }
        return $correctiveAction;
    }
    
    //function for adding a record to the correctiveAction table in the db
    function addCorrectiveAction($correctiveAction) {
        
        $submittedby_id = $_SESSION["loggedid"];
        $correctiveAction->id = UUID::v4();
        
        $query = "INSERT INTO corrective_action (id,finding_num,status,description,finding_priority,start_date,finding_priority_date,finish_date,submittedby_id)"
                . "VALUES ('$correctiveAction->id','$correctiveAction->finding_num','$correctiveAction->status','$correctiveAction->description','$correctiveAction->finding_priority','$correctiveAction->start_date','$correctiveAction->finding_priority_date','$correctiveAction->finish_date','$submittedby_id');";

        mysqli_query($this->plink, $query);
        // close connection

      //  mysqli_close($this->plink);
   
        $url = "../view/correctiveActionList.php";
        
        redirect($url);
    }


    //deleting an correctiveAction instance from the db
    function deleteCorrectiveAction($id,$all=false){
		
		if($all){
			$query="DELETE from corrective_action  where id in (".$id.")";
		}else{
			$query="DELETE from corrective_action  where id="."'$id'";	
		}
		
		mysqli_query($this->plink,$query);
		// close connection
		//mysqli_close($this->plink);
               
	}

        //updating an correctiveAction instance in the db
    function editCorrectiveAction($correctiveAction) {

        //$this->perm_desc = $_POST['correctiveAction_desc'];

       // $modifieddate = date("d-m-Y H:i:s");
        $modifiedby_id = $_SESSION["loggedid"];

        $query = "UPDATE corrective_action SET finding_num='$correctiveAction->finding_num',status='$correctiveAction->status',description='$correctiveAction->description',finding_priority='$correctiveAction->finding_priority',start_date='$correctiveAction->start_date',finding_priority_date='$correctiveAction->finding_priority_date',finish_date='$correctiveAction->finish_date',
   			modifiedby_id='$modifiedby_id' WHERE id=" . "'$correctiveAction->id'";
        mysqli_query($this->plink, $query);
        // close connection
       // mysqli_close($this->plink);
        $url = "../view/correctiveActionList.php";

        redirect($url);
    }

    //function for returning a record in the correctiveAction table
    function correctiveAction($row) {
        if (!empty($row)) {
            $correctiveAction = new CorrectiveAction();
            foreach ($row as $key => $value) {
                $correctiveAction->$key = $value;
            }
            return $correctiveAction;
        }
    }

    //function for returning all correctiveAction objects in the db
    function getCorrectiveActions() {

        //sql to return all correctiveAction objects
        $sql = "SELECT * from corrective_action";
        $correctiveActions = array();
        $result = mysqli_query($this->plink, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $correctiveActions[] = $this->correctiveAction($row);
        }

        return $correctiveActions;
    }
     public function showFindingOptions() {

        $sql = "SELECT * from findings";
   //debugout($sql);
        $result = mysqli_query($this->plink, $sql);

        $opt = '';
        while ($row = mysqli_fetch_assoc($result)) {

            $opt .='<option value="' . $row['finding_num'] . '">' . $row['finding_num'] . '</option>';
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

//    function getCorrectiveActionName() {
//       return $this->name;
//    }

}
