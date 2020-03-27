<?php
class ToReferenceValidation{
    public $ERROR_MSG = '';
    
    //constructor
    function ToReferenceValidation(){}
    
    //function for validation
    function validate($data){
        
        $error = false;
        
                if(empty($data->tor_to)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter Terms of Reference Start Date. <br>';
			$error= true;
		} 
                if(empty($data->tor_cc)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter Cc. <br>';
			$error= true;
		} 
                if(empty($data->audit_date)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Audit Date. <br>';
			$error= true;
		} 
                if(empty($data->audit_ref_num)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Audit Reference Number. <br>';
			$error= true;
		} 
                if(empty($data->scp_number)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Scope Number. <br>';
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
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Unit Name. <br>';
			$error= true;
		}
                  if(empty($data->objective)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Objective. <br>';
			$error= true;
		}
                  if(empty($data->assignm_strategy)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Assignment Strategy. <br>';
			$error= true;
		}
                  if(empty($data->deliverables)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Deliverables. <br>';
			$error= true;
		}
                  if(empty($data->report_dist)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Report Distribution. <br>';
			$error= true;
		}
                   if(empty($data->overview_audit_cov)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Overview Audit Cover. <br>';
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
