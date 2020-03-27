<?php

class CrtElementValidation {

    public $ERROR_MSG = '';

    function CrtElementValidation() {
        
    }

    function validate($data) {

        $error = false;

        if (empty($data->crt_area)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Control Area. <br>';
            $error = true;
        }
if (empty($data->speciality)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Speciality. <br>';
            $error = true;
        }if (empty($data->description)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Description. <br>';
            $error = true;
        }
        if ($error) {
            return false;
        }
        return true;
    }

    public function valInput($data) {
        //  $data = trim($data);
        // $data = mysqli_real_escape_string($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
?>

