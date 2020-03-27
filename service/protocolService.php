<?php
require_once  'commonService.php';
require_once '../model/protocol.php';


class ProtocolService {

    public $plink;
    public $ERROR_MSG ='';
    public $protocol;

    //constructor
    function ProtocolService() {
        global $link;
        $this->plink = $link;
    }

    //function for returning an instance of aircraft movement by id
    public function getProtocol($id) {
        //sql to return user object
        $protocol = new Protocol();
        $sql = "select * from protocol where id='"."$id"."'";

        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($count == 1) {
            $protocol = $this->protocol($row);
        }

        return $protocol;
    }

    //function for returning a row fom aircraft movement in db
    public static function protocol($row) {
        if (!empty($row)) {
            $protocol = new Protocol();
            foreach ($row as $key => $value) {
                $protocol->$key = $value;
            }
            return $protocol;
        }
    }

    //function for returning all rows from aircraft movement in db
    public function getProtocols() {
        //sql to return all user objects
        $sql = "select * from protocol";
        $result = mysqli_query($this->plink, $sql);
        $protocols = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $protocols[] = $this->protocol($rows);
        }
        return $protocols;
    }
    //function for returning values from aircraft movement list but with a particular limit
    public function getProtocolList($limit) {
        //sql to return all user objects
        $start=0;
        $limit=100;
        $sidx='name';
        $sql = "SELECT * FROM protocol ORDER BY $sidx LIMIT $start , $limit"; 
        $result = mysqli_query($this->plink, $sql);
        $protocols = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $protocols[] = $this->protocol($rows);
        }
        return $protocols;
    }

    //function for creating a new instance of aircraft movement in db
    public function add($protocol) {

        $protocol->id = UUID::v4();
        $submittedby_id = $_SESSION["loggedid"];  

        $query = "INSERT INTO protocol (id,scp_number,pro_number,dept_id,section_id,unit_id,pro_reference,pro_question,submittedby_id)
   		VALUES ('$protocol->id','$protocol->scp_number','$protocol->pro_number','$protocol->dept_id','$protocol->section_id','$protocol->unit_id','$protocol->pro_reference','$protocol->pro_question','$submittedby_id');";
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
    public function edit($protocol) {

        $modifiedby_id = $_SESSION["loggedid"];
       
        $query = "UPDATE protocol SET scp_number='$protocol->scp_number',pro_number='$protocol->pro_number',dept_id='$protocol->dept_id',section_id='$protocol->section_id',unit_id='$protocol->unit_id',pro_reference='$protocol->pro_reference',pro_question='$protocol->pro_question',
   			modifiedby_id='$modifiedby_id' WHERE id=" . "'$protocol->id'";

       $result=mysqli_query($this->plink, $query);
        if (!$result) {
            $this->ERROR_MSG = $this->ERROR_MSG.'Error: ' . mysqli_error($this->plink) . "<br>";
            return $this->ERROR_MSG;
        }
        // close connection
        mysqli_close($this->plink);
        $url = "../view/protocolView.php?id=$protocol->id";

        redirect($url);
    }

    //function for deleting a row from aircraft movement by id
     public function getDelete($id,$all=false) {
        
       // if (!is_null($id) || !empty($id)) {
            if ($all) {
                $query = "DELETE from protocol  where id in (" . $id . ")";
            } else {
                $query = "DELETE from protocol  where id=" . "'$id'";
            }

            mysqli_query($this->plink, $query);
            // close connection
           // mysqli_close($this->plink);
        }
       // $url = "../view/protocolList.php";
       // redirect($url);
   // }

    //function for numbering all records in aircraft movement
    public function getCount($id) {

        $query = "select * from protocol  where id=" . $id;
        $result = mysqli_query($this->plink, $query);
        return mysqli_num_rows($result);
    }
     public function validateBeforeImport() {
        //TODO
        
    }
    
    public function doImport($modelItem) {
        //TODO
        
        
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
    }
  
  
 

}


