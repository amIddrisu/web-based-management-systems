<?php

class DepartmentValidation {

    public $ERROR_MSG = '';

    function DepartmentValidation() {
        
    }

    function validate($data) {

        $error = false;

        if (empty($data->name)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter The Department Name. <br>';
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

