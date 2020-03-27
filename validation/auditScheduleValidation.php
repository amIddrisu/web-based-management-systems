<?php
class AuditScheduleValidation{
    public $ERROR_MSG = '';
    
    //constructor
    function AuditScheduleValidation(){}
    
    //function for validation
    function validate($data){
        
        $error = false;
        
                if(empty($data->from_date)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Audit Schedule Start Date. <br>';
			$error= true;
		} 
                if(empty($data->scp_number)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter Scope Number. <br>';
			$error= true;
		} 
                if(empty($data->dept_id)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Department Name. <br>';
			$error= true;
		} 
                if(empty($data->section_id)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Section Name. <br>';
			$error= true;
		} 
                if(empty($data->unit_id)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please The Unit Name. <br>';
			$error= true;
		} 
                  if(empty($data->to_date)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter Audit Schedule Finish Date. <br>';
			$error= true;
		} 
		
                if($error){
			return false;
		}
		return true;    
    }
        public function valInput($data) {
       // $data = trim($data);
       // $data = mysqli_real_escape_string($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>
