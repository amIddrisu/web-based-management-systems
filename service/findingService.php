<?php
require_once  'commonService.php';
require_once '../model/finding.php';


class FindingService {

    public $plink;
    public $ERROR_MSG ='';
    public $finding;

    //constructor
    function FindingService() {
        global $link;
        $this->plink = $link;
    }

    //function for returning an instance of aircraft movement by id
    public function getFinding($id) {
        //sql to return user object
        $finding = new Finding();
        $sql = "select * from findings where id='"."$id"."'";

        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($count == 1) {
            $finding = $this->finding($row);
        }

        return $finding;
    }

    //function for returning a row fom aircraft movement in db
    public static function finding($row) {
        if (!empty($row)) {
            $finding = new Finding();
            foreach ($row as $key => $value) {
                $finding->$key = $value;
            }
            return $finding;
        }
    }

    //function for returning all rows from aircraft movement in db
    public function getFindings() {
        //sql to return all user objects
        $sql = "select * from findings";
        $result = mysqli_query($this->plink, $sql);
        $findings = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $findings[] = $this->finding($rows);
        }
        return $findings;
    }
    //function for returning values from aircraft movement list but with a particular limit
    public function getFindingList($limit) {
        //sql to return all user objects
        $start=0;
        $limit=100;
        $sidx='name';
        $sql = "SELECT * FROM findings ORDER BY $sidx LIMIT $start , $limit"; 
        $result = mysqli_query($this->plink, $sql);
        $findings = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $findings[] = $this->finding($rows);
        }
        return $findings;
    }

    //function for creating a new instance of aircraft movement in db
    public function add($finding) {

        $finding->id = UUID::v4();
        $submittedby_id = $_SESSION["loggedid"];  

        $query = "INSERT INTO findings (id,finding_num,pro_number,audit_ref_num,description,recommendation,evidence,submittedby_id)
   		VALUES ('$finding->id','$finding->finding_num','$finding->pro_number','$finding->audit_ref_num','$finding->description','$finding->recommendation','$finding->evidence','$submittedby_id');";
        //debugout($query);
        $result=mysqli_query($this->plink, $query);
        if (!$result) {
            $this->ERROR_MSG = $this->ERROR_MSG.'Error: ' . mysqli_error($this->plink) . "<br>";
            return $this->ERROR_MSG;
        }
        // close connection

       // mysqli_close($this->plink);
        
    }

    //function for updating aircraft movement instance
    public function edit($finding) {

        $modifiedby_id = $_SESSION["loggedid"];
       
        $query = "UPDATE findings SET finding_num='$finding->finding_num',pro_number='$finding->pro_number',audit_ref_num='$finding->audit_ref_num',recommendation='$finding->recommendation',evidence='$finding->evidence',
   			modifiedby_id='$modifiedby_id' WHERE id=" . "'$finding->id'";

       $result=mysqli_query($this->plink, $query);
        if (!$result) {
            $this->ERROR_MSG = $this->ERROR_MSG.'Error: ' . mysqli_error($this->plink) . "<br>";
            return $this->ERROR_MSG;
        }
        // close connection
        mysqli_close($this->plink);
        $url = "../view/findingView.php?id=$finding->id";

        redirect($url);
    }

    //function for deleting a row from aircraft movement by id
     public function getDelete($id,$all=false) {
        
       // if (!is_null($id) || !empty($id)) {
            if ($all) {
                $query = "DELETE from findings  where id in (" . $id . ")";
            } else {
                $query = "DELETE from findings  where id=" . "'$id'";
            }

            mysqli_query($this->plink, $query);
            // close connection
           // mysqli_close($this->plink);
        }
       // $url = "../view/findingList.php";
       // redirect($url);
   // }

    //function for numbering all records in aircraft movement
    public function getCount($id) {

        $query = "select * from findings  where id=" . $id;
        $result = mysqli_query($this->plink, $query);
        return mysqli_num_rows($result);
    }
     public function validateBeforeImport() {
        //TODO
        
    }
    
    public function doImport($modelItem) {
        //TODO
        
        
    }
        public function showProtocolOptions() {

        $sql = "SELECT * from protocol";
   //debugout($sql);
        $result = mysqli_query($this->plink, $sql);

        $opt = '';
        while ($row = mysqli_fetch_assoc($result)) {

            $opt .='<option value="' . $row['pro_number'] . '">' . $row['pro_number'] . '</option>';
        }
        echo $opt;
    }
 

}


