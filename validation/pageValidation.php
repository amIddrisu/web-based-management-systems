<?php

class pageValidation {

    public $ERROR_MSG = '';

    function pageValidation() {
        
    }

    function validate($data) {

        $error = false;

        if (empty($data->page_desc)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Page Description. <br>';
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

