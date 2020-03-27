<?php

class role_permValidation {

    public $ERROR_MSG = '';

    function role_permValidation() {
        
    }

    function validate($data) {

        $error = false;

        if ($data->role_id=="null") {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Select Role. <br>';
            $error = true;
        }
         if ($data->page_id=="null") {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Select Page. <br>';
            $error = true;
        }

        if ($error) {
            return false;
        }
        return true;
    }

}
?>

