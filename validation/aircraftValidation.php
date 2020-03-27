<?php
class aircraftValidation{
    public $ERROR_MSG = '';
    function aircraftValidation(){}
    function validate($data){
        
        $error = false;
        
        if(empty($data->name)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter Aircraft Registration. <br>';
			$error= true;
		}  
		if(empty($data->aircrafttype)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter Airport Type. <br>';
			$error= true; 
		}
		if(empty($data->weight)){
			$this->ERROR_MSG = $this->ERROR_MSG .'Please Enter Weight. <br>';
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
