<?php
class ProtocolValidation{
    public $ERROR_MSG = '';
    function ProtocolValidation(){}
    function validate($data){
        
        $error = false;
        
        if(empty($data->scp_number)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Scope Number. <br>';
			$error= true;
		}  
		if(empty($data->pro_number)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Protocol Number. <br>';
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
                if(empty($data->pro_reference)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Protocol Reference. <br>';
			$error= true;
		}
                  if(empty($data->pro_question)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter The Protocol Question. <br>';
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
