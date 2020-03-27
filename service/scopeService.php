<?php
require_once  'commonService.php';
require_once '../model/scope.php';


class ScopeService {

    public $plink;
    public $ERROR_MSG ='';
    public $scope;

    //constructor
    function ScopeService() {
        global $link;
        $this->plink = $link;
    }

    //function for returning an instance of aircraft movement by id
    public function getScope($id) {
        //sql to return user object
        $scope = new Scope();
        $sql = "select * from scope where id='"."$id"."'";

        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($count == 1) {
            $scope = $this->scope($row);
        }

        return $scope;
    }

    //function for returning a row fom aircraft movement in db
    public static function scope($row) {
        if (!empty($row)) {
            $scope = new Scope();
            foreach ($row as $key => $value) {
                $scope->$key = $value;
            }
            return $scope;
        }
    }

    //function for returning all rows from aircraft movement in db
    public function getScopes() {
        //sql to return all user objects
        $sql = "select * from scope";
        $result = mysqli_query($this->plink, $sql);
        $scopes = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $scopes[] = $this->scope($rows);
        }
        return $scopes;
    }
    //function for returning values from aircraft movement list but with a particular limit
    public function getScopeList($limit) {
        //sql to return all user objects
        $start=0;
        $limit=100;
        $sidx='name';
        $sql = "SELECT * FROM scope ORDER BY $sidx LIMIT $start , $limit"; 
        $result = mysqli_query($this->plink, $sql);
        $scopes = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $scopes[] = $this->scope($rows);
        }
        return $scopes;
    }

    //function for creating a new instance of aircraft movement in db
    public function add($scope) {

        $scope->id = UUID::v4();
        $submittedby_id = $_SESSION["loggedid"];  

        $query = "INSERT INTO scope (id,scp_number,description,dept_id,section_id,unit_id,submittedby_id)
   		VALUES ('$scope->id','$scope->scp_number','$scope->description','$scope->dept_id','$scope->section_id','$scope->unit_id','$submittedby_id');";
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
    public function edit($scope) {

        $modifiedby_id = $_SESSION["loggedid"];
       
        $query = "UPDATE scope SET scp_number='$scope->scp_number',description='$scope->description',dept_id='$scope->dept_id',section_id='$scope->section_id',unit_id='$scope->unit_id',
   			modifiedby_id='$modifiedby_id' WHERE id=" . "'$scope->id'";

       $result=mysqli_query($this->plink, $query);
        if (!$result) {
            $this->ERROR_MSG = $this->ERROR_MSG.'Error: ' . mysqli_error($this->plink) . "<br>";
            return $this->ERROR_MSG;
        }
        // close connection
        mysqli_close($this->plink);
        $url = "../view/scopeView.php?id=$scope->id";

        redirect($url);
    }

    //function for deleting a row from aircraft movement by id
     public function getDelete($id,$all=false) {
        
       // if (!is_null($id) || !empty($id)) {
            if ($all) {
                $query = "DELETE from scope  where id in (" . $id . ")";
            } else {
                $query = "DELETE from scope  where id=" . "'$id'";
            }

            mysqli_query($this->plink, $query);
            // close connection
           // mysqli_close($this->plink);
        }
       // $url = "../view/scopeList.php";
       // redirect($url);
   // }

    //function for numbering all records in aircraft movement
    public function getCount($id) {

        $query = "select * from scope  where id=" . $id;
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
   
  
  
 

}


