<?php
class FindingValidation{
    public $ERROR_MSG = '';
    function FindingValidation(){}
    function validate($data){
        
        $error = false;
        
        if(empty($data->finding_num)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Finding Number. <br>';
			$error= true;
		}  
		if(empty($data->pro_number)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Protocol Number. <br>';
			$error= true; 
		}
		if(empty($data->audit_ref_num)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Audit Reference Number. <br>';
			$error= true;
		}
                if(empty($data->description)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Description. <br>';
			$error= true;
		}
                if(empty($data->recommendation)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Recommendation. <br>';
			$error= true;
		}
                if(empty($data->evidence)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Evidence. <br>';
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
